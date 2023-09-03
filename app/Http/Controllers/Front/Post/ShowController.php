<?php

namespace App\Http\Controllers\Front\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\Front\Post\ShowResource;
use App\Models\Post;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __invoke(Post $post): \Illuminate\Http\JsonResponse
    {
        try {

            return response()->json([
                'status' => true,
                'message' => 'Post Get Successfully',
                "post" =>  new ShowResource($post)
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
