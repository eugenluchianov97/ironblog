<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StoreController extends Controller
{

    public function __invoke(StoreRequest $request): \Illuminate\Http\JsonResponse
    {
        try {

            $data = $request->validated();


            if(!Auth::user()->can_create_user($data['role'])){
                return response()->json([
                    'status' => false,
                    'message' => 'Permission denied',

                ], 405);
            }


            $userData = [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ];



            if(isset($data['role']) && in_array($data['role'], User::ROLES_FOR_CREATE)){

                $userData['role'] = $data['role'];
            }





            User::create($userData);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
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
