<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class LogoutController extends Controller
{
    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
//            $request->user()->currentAccessToken()->delete();
//            auth()->user()->tokens()->delete();
            $request->user()->tokens()->delete();
            return response()->json([
                'status' => true,
                'message' => 'User Logout Successfully',
                'user' => $request->user()->currentAccessToken()
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
