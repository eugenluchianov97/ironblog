<?php

namespace App\Http\Controllers\Admin\Password;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Account\IndexResource;
use App\Mail\SendCodeResetPassword;
use App\Models\ResetCodePassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use function response;

class ForgotPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $data = $request->validate([
                'email' => 'required|email|exists:users',
            ]);

            // Delete all old code that user send before.
            ResetCodePassword::where('email', $request->email)->delete();

            // Generate random code
            $data['code'] = mt_rand(100000, 999999);

            // Create a new code
            $codeData = ResetCodePassword::create([
                   'code' => mt_rand(100000, 999999),
                   'email' => $request->email
            ]);

            // Send email to user
            Mail::to($request->email)->send(new SendCodeResetPassword($codeData->code));

            return response()->json([
                'status' => true,
                'message' => 'Password send Successfully',

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
