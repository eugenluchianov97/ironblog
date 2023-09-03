<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeleteController extends Controller
{

    public function __invoke(Category $category): \Illuminate\Http\JsonResponse
    {
        try {
            if(!Auth::user()->can_delete_categories()){
                return response()->json([
                    'status' => false,
                    'message' => 'Permission denied',

                ], 405);
            }
            $category->delete();
            return response()->json([
                'status' => true,
                'message' => 'Categories Deleted Successfully',
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
