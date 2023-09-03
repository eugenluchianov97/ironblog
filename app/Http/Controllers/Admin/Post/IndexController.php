<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Post\IndexResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{

    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        try {

            $n = 10;
            $collection = Post::where('id', '>', 0);
            if($request->has('q')){
                $collection->where(function($query) use($request) {
                    $query->where('title','LIKE',"%$request->q%")
                        ->orWhere('title_ro','LIKE',"%$request->q%")
                        ->orWhere('title_en','LIKE',"%$request->q%")
                        ->orWhere('content','LIKE',"%$request->q%")
                        ->orWhere('content_ro','LIKE',"%$request->q%")
                        ->orWhere('content_en','LIKE',"%$request->q%");
                });
            }

            if($request->has('category_id')){
                $collection->where(function($query) use($request) {
                    $query->where('category_id',$request->category_id);
                });
            }


            if(Auth::user()->is_user()){
                $collection->where('user_id',Auth::id());
            }
            $posts = $collection->paginate($n);

            IndexResource::collection($posts);

            return response()->json([
                'status' => true,
                'message' => 'Categories Get Successfully',
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
