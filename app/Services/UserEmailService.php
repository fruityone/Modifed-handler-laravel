<?php

namespace App\Services;

use App\Mail\EmailChangeCode;
use App\Mail\PasswordReset;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Symfony\Component\Mailer\Exception\TransportException;

/**
 * Class UserMailService.
 */
class UserEmailService
{

    public function sendRandomCodeEmail($validatedMailData) : JsonResponse | string
    {
        $verificationCode=str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        try{
        Mail::to($validatedMailData)->send(new EmailChangeCode($verificationCode));
    } catch (TransportException $e) {
            Log::error('Email sending failed: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to send email. Please try again later.'], 500);
        }
        return $verificationCode;
    }
    public function sendPasswordReset($validatedMailData) {
        $token=Str::random(64);
        try {
            Mail::to($validatedMailData)->send(new PasswordReset($token));
        }
        catch (TransportException $e){
            Log::error('Email sending failed: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to send email. Please try again later.'], 500);
        }
        return $token;
    }
}
