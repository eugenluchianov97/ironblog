<?php

namespace App\Http\Controllers\Front\Contact;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\Contact\MailRequest;
use App\Mail\ContactUsMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function __invoke(MailRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $data = $request->validated();

            $dataArray = [
                'name' => $data['name'],
                'subject' => $data['subject'],
                'email' => $data['email'],
                'message' => $data['message']
            ];

            $sendToEmail = strtolower('toEmailAddress@gmail.com');
            if(!empty($sendToEmail) && filter_var($sendToEmail, FILTER_VALIDATE_EMAIL)){
                Mail::to($sendToEmail)->send(new ContactUsMail($dataArray));
            }

            return response()->json([
                'status' => true,
                'message' => 'send Successfully',
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
