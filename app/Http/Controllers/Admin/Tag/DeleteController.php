<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeleteController extends Controller
{
    public function __invoke(Tag $tag): \Illuminate\Http\JsonResponse
    {
        try {
            if(!Auth::user()->can_delete_tags()){
                return response()->json([
                    'status' => false,
                    'message' => 'Permission denied',

                ], 405);
            }

            $tag->delete();
            return response()->json([
                'status' => true,
                'message' => 'Tag Deleted Successfully',
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
