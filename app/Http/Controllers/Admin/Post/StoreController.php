<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\StoreRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $data = $request->validated();


            if ($data['image']) {
                $image = $request->file('image')->store(options: 'posts');

                Image::make('storage/posts/'.$image)->fit(1200, 600)->save('storage/posts/1200x600/'.$image);
                Image::make('storage/posts/'.$image)->fit(360, 220)->save('storage/posts/360x220/'.$image);
                Image::make('storage/posts/'.$image)->fit(360, 220)->fit(745, 495)->save('storage/posts/745x495/'.$image);


            }

            $postData = [
                'title' => $data['title'],
                'title_ro' => $data['title_ro'] === null ? $data['title'] : $data['title_ro'],
                'title_en' => $data['title_en'] === null ? $data['title'] : $data['title_en'],
                'content' => $data['content'],
                'content_ro' => $data['content_ro'] === null ? $data['content'] : $data['content_ro'],
                'content_en' => $data['content_en'] === null ? $data['content'] : $data['content_en'],
                'category_id' => $data['category_id'],
                'image' => $image ?? null,
                'user_id' => Auth::id()
            ];

            $post = Post::create($postData);

            if($data['tags']){
                $tags = array_map('intval', explode(',', $data['tags']));
                $post->tags()->attach($tags);
            }


            return response()->json([
                'status' => true,
                'message' => 'Post Created Successfully',
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
