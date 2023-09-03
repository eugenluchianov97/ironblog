<?php

namespace App\Http\Controllers\Admin\Password;


use App\Http\Controllers\Controller;
use App\Models\ResetCodePassword;
use App\Models\User;
use Illuminate\Http\Request;
use function now;
use function response;

class CodeCheckController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        try {
            $request->validate([
                'code' => 'required|string|exists:reset_code_passwords',
                'password' => 'required|string|min:6',
            ]);

            // find the code
            $passwordReset = ResetCodePassword::firstWhere('code', $request->code);

            // check if it does not expired: the time is one hour
            if ($passwordReset->created_at > now()->addHour()) {
                $passwordReset->delete();
                return response()->json([
                    'status' => false,
                    'message' => 'Code is expired!',
                ], 422);

            }

            // find user's email
            $user = User::firstWhere('email', $passwordReset->email);

            // update user password
            $user->update($request->only('password'));

            // delete current code
            $passwordReset->delete();


            return response()->json([
                'status' => true,
                'message' => 'Password Set Successfully',
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
