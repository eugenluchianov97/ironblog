<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateController extends Controller
{

    public function __invoke(UpdateRequest $request,Category $category)
    {

        try {
            if(!Auth::user()->can_edit_categories()){
                return response()->json([
                    'status' => false,
                    'message' => 'Permission denied',

                ], 405);
            }
            $data = $request->validated();
            $category->name = $data['name'];
            $category->name_ro = $data['name_ro'] === null ? $data['name']:$data['name_ro'];
            $category->name_en = $data['name_en'] === null ? $data['name']:$data['name_en'];

            $category->save();

            return response()->json([
                'status' => true,
                'message' => 'Category Updated Successfully',
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
