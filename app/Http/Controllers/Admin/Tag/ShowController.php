<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Tag\ShowResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __invoke(Tag $tag): \Illuminate\Http\JsonResponse
    {
        try {

            return response()->json([
                'status' => true,
                'message' => 'Tag Get Successfully',
                "tag" =>  new ShowResource($tag)
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
