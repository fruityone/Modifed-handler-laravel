<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetRequest;
use App\Http\Requests\SendResetEmailRequest;
use App\Interfaces\PasswordResetInterface;
use App\Interfaces\UserInterface;
use App\Models\PasswordReset;
use App\Services\PasswordResetService;
use App\Services\UserEmailService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserPasswordController extends Controller
{
    private PasswordResetService $passwordResetService;
    private UserEmailService $userEmailService;
    private PasswordResetInterface $passwordResetRepository;
    private UserInterface $userRepository;
    public function __construct(
        PasswordResetService $passwordResetService,
        UserEmailService $userEmailService,
        PasswordResetInterface $passwordResetRepository,
        UserInterface $userRepository)
    {
    $this->passwordResetService = $passwordResetService;
    $this->userEmailService = $userEmailService;
    $this->passwordResetRepository = $passwordResetRepository;
    $this->userRepository = $userRepository;
    }

    public function sendResetEmail(SendResetEmailRequest $request) : JsonResponse
    {
        $resetData=$request->validated();
        $token=$this->userEmailService->sendPasswordReset($resetData['email']);
        $this->passwordResetService->updateOrInsertPasswordReset($resetData['email'],$token);
        return response()->json(['message'=>'Link sent successfully']);
    }
    public function resetPassword(ResetRequest $request){
        $resetData=$request->validated();
        $passwordReset = $this->passwordResetRepository->getPasswordResetDetails($resetData['email']);
        if($passwordReset && Hash::check($resetData['token'],$passwordReset->token)){
        $user=$this->userRepository->getByEmail($resetData['email']);
        $user->update(['password' => bcrypt('password')]);
        PasswordReset::where('email', $resetData['email'])->delete();
            return response()->json(['message'=>'Password changed successfully']);
        }
        return response()->json([
            'error' => 'Invalid token.',
        ], 400);
    }
}
