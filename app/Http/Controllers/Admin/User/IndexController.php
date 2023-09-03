<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\User\IndexResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{

    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            if(!Auth::user()->can_read_user()){
                return response()->json([
                    'status' => false,
                    'message' => 'Permission denied',

                ], 405);
            }

            $users = User::all();

            return response()->json([
                'status' => true,
                'message' => 'Users Get Successfully',
                "users" =>  IndexResource::collection($users),
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
