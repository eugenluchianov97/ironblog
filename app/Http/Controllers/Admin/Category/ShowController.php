<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Category\IndexResource;
use App\Http\Resources\Admin\Category\ShowResource;
use App\Models\Category;
use Illuminate\Http\Request;

class ShowController extends Controller
{

    public function __invoke(Category $category): \Illuminate\Http\JsonResponse
    {
        try {

            return response()->json([
                'status' => true,
                'message' => 'Category Get Successfully',
                "category" =>  new ShowResource($category)
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
