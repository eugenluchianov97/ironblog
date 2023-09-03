<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tag\StoreRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{

    public function __invoke(StoreRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            if(!Auth::user()->can_create_tags()){
                return response()->json([
                    'status' => false,
                    'message' => 'Permission denied',

                ], 405);
            }
            $data = $request->validated();


            $data['name_ro'] = $data['name_ro'] === null ? $data['name'] : $data['name_ro'];
            $data['name_en'] = $data['name_en'] === null ? $data['name'] : $data['name_en'];




            $tag = Tag::create($data);

            return response()->json([
                'status' => true,
                'message' => 'Tag Created Successfully',
                "tag" => $tag->name
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
