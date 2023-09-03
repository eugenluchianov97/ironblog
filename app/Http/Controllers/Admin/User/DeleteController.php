<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeleteController extends Controller
{

    public function __invoke(User $user): \Illuminate\Http\JsonResponse
    {
        try {
            if(!Auth::user()->can_delete_user($user)){
                return response()->json([
                    'status' => false,
                    'message' => 'Permission denied',

                ], 405);
            }
            $user->posts()->delete();
            $user->delete();
            return response()->json([
                'status' => true,
                'message' => 'User Deleted Successfully',
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
