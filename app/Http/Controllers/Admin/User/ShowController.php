<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\User\ShowResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowController extends Controller
{

    public function __invoke(User $user): \Illuminate\Http\JsonResponse
    {
        try {
//            if(Auth::user()->role !== User::ROLE_ADMIN && Auth::user()->role !== User::ROLE_ADMIN_SUPER){
//                return response()->json([
//                    'status' => false,
//                    'message' => 'Permission denied',
//
//                ], 405);
//            }

            return response()->json([
                'status' => true,
                'message' => 'Category Get Successfully',
                "user" =>  new ShowResource($user)
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
