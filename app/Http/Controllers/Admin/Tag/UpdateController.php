<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tag\StoreRequest;
use App\Http\Requests\Admin\Tag\UpdateRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request,Tag $tag): \Illuminate\Http\JsonResponse
    {
        try {
            if(!Auth::user()->can_edit_tags()){
                return response()->json([
                    'status' => false,
                    'message' => 'Permission denied',

                ], 405);
            }
            $data = $request->validated();

            $tag->name = $data['name'];
            $tag->name_ro = $data['name_ro'] === null ? $data['name']:$data['name_ro'];
            $tag->name_en = $data['name_en'] === null ? $data['name']:$data['name_en'];


            $tag->save();

            return response()->json([
                'status' => true,
                'message' => 'Tag Updated Successfully',
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
