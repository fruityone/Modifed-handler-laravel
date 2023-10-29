<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailChangeRequest;
use App\Http\Requests\EmailSendRequest;
use App\Interfaces\UserSettingsInterface;
use App\Services\UserAccountService;
use App\Services\UserEmailService;
use App\Services\UserSettingsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserEmailController extends Controller
{
    private UserAccountService $userAccountService;

    public function __construct(
        UserSettingsInterface $userSettingsRepository,
        UserEmailService $userEmailService,
        UserSettingsService $userSettingsService,
        UserAccountService $userAccountService,
    )
    {
        $this->userSettingsRepository = $userSettingsRepository;
        $this->userEmailService = $userEmailService;
        $this->userSettingsService = $userSettingsService;
        $this->userAccountService = $userAccountService;
    }

    public function sendEmail(EmailSendRequest $request) : JsonResponse
    {
        $validatedMailData = $request->validated();
        $verifyCode = $this->userEmailService->sendRandomCodeEmail($validatedMailData['email']);
        $this->userSettingsService->updateOrInsertEmailCode($verifyCode,$validatedMailData['email']);
        return response()->json(['message' => 'Confirmation code sent to your email successfully']);
    }

    public function changeEmail(EmailChangeRequest $request)
    {
        $validatedVerifyInfo=$request->validated();
        $userSettings = $this->userSettingsRepository->getUserSettingsById(auth('sanctum')->id());
        if(Hash::check($validatedVerifyInfo['verify_code'],$userSettings->email_change_code)){
        $this->userAccountService->updateUserEmail(auth('sanctum')->id(),$userSettings->preferred_email);
        $this->userSettingsService->resetEmailUpdateSettings($userSettings);
            return response()->json(['message' => 'Email changed successfully']);
        }
            return response()->json(['message' => 'Invalid verification code']);
    }
}
