<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{

    public function __invoke(StoreRequest $request): \Illuminate\Http\JsonResponse
    {

        try {
            if(!Auth::user()->can_create_categories()){
                return response()->json([
                    'status' => false,
                    'message' => 'Permission denied',

                ], 405);
            }

            $data = $request->validated();

            $data['name_ro'] = $data['name_ro'] === null ? $data['name'] : $data['name_ro'];
            $data['name_en'] = $data['name_en'] === null ? $data['name'] : $data['name_en'];

            $category = Category::create($data);

            return response()->json([
                'status' => true,
                'message' => 'Category Created Successfully',
                "category" => $category->name
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
