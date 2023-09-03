<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Post\ShowResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowController extends Controller
{
    public function __invoke(Post $post): \Illuminate\Http\JsonResponse
    {
        try {
            if(!Auth::user()->can_view_post($post)){
                return response()->json([
                    'status' => false,
                    'message' => 'Permission denied',

                ], 405);
            }

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
