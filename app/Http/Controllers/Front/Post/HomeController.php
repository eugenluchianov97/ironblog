<?php

namespace App\Http\Controllers\Front\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\Front\Post\HomeResource;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $posts = Post::latest()->take(3)->get();
            return response()->json([
                'status' => true,
                'message' => 'Posts Get Successfully',
                "posts" => HomeResource::collection($posts),
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
