<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Account\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateController extends Controller
{

    public function __invoke(UpdateRequest $request, User $user): \Illuminate\Http\JsonResponse
    {
        try {

            if(Auth::id() !== $user->id){
                return response()->json([
                    'status' => false,
                    'message' => 'Permission denied',

                ], 405);
            }

            $data = $request->validated();



            $user->name = $data['name'];
            $user->email = $data['email'];

            /** супер админ не может менять себе роль **/


            if(isset($data['password'])){
                $user->password = $data['password'];
            }

            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'User Updated Successfully',
                'user' => $user,
                '_auth' => Auth::id(),
                '_user->id' => $user->id

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
