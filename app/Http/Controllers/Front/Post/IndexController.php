<?php

namespace App\Http\Controllers\Front\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\Front\Post\BlogResource;
use App\Http\Resources\Front\Post\HomeResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class IndexController extends Controller
{

    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $n = 6;
            $collection = Post::latest();
            if($request->has('category') && $request->category !== null){

                $collection = $collection->where('category_id',$request->category);

            }
            if($request->has('tag') && $request->tag !== null){
                $collection = $collection->whereHas('tags', function($q) use ($request) {
                    $q->where('tag_id', $request->tag);
                });
            }

            if($request->has('q') && $request->q !== null){
                $collection = $collection->where('title','LIKE', '%'. Str::lower($request->q) .'%')
                    ->orWhere('title_ro','LIKE', '%'. Str::lower($request->q) .'%')
                    ->orWhere('title_en','LIKE', '%'. Str::lower($request->q) .'%')
                    ->orWhere('content','LIKE', '%'. Str::lower($request->q) .'%')
                    ->orWhere('content_ro','LIKE', '%'. Str::lower($request->q) .'%')
                    ->orWhere('content_en','LIKE', '%'.  Str::lower($request->q) .'%' );
            }


            $posts = $collection->latest()->paginate($n);
            BlogResource::collection($posts);

            return response()->json([
                'status' => true,
                'message' => 'Posts Get Successfully',
                "posts" => $posts,
            ], 200);
        }
        catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
