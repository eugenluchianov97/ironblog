<?php

namespace App\Http\Controllers\Front\Tag;

use App\Http\Controllers\Controller;
use App\Http\Resources\Front\Tag\IndexResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $tags = Tag::all();
            return response()->json([
                'status' => true,
                'message' => 'Tags Get Successfully',
                "tags" => IndexResource::collection($tags),
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
