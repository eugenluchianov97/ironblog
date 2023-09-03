<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\UpdateRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateController extends Controller
{

    public function __invoke(UpdateRequest $request, Post $post): \Illuminate\Http\JsonResponse
    {
        try {

            if(!Auth::user()->can_edit_post($post)){
                return response()->json([
                    'status' => false,
                    'message' => 'Permission denied',

                ], 405);
            }
            $data = $request->validated();


            $post->title = $data['title'];
            $post->title_ro = $data['title_ro'];
            $post->title_en = $data['title_en'];
            $post->content = $data['content'];
            $post->content_ro = $data['content_ro'];
            $post->content_en = $data['content_en'];
            $post->category_id = $data['category_id'];

            if ($data['image']) {
                $image = $request->file('image')->store(options: 'posts');
                $post->image = $image;
            }

            $post->save();

            if($data['tags']){
                $tags = array_map('intval', explode(',', $data['tags']));
                $post->tags()->sync($tags);
            }

            return response()->json([
                'status' => true,
                'message' => 'Post Updated Successfully',
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
