<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Interfaces\UserInterface;
use App\Services\AuthService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    private AuthService $authService;
    private UserInterface $userRepository;

    public function __construct(AuthService $service, UserInterface $userRepository)
    {
        $this->authService = $service;
        $this->userRepository = $userRepository;
    }
    public function register(RegisterRequest $request) : Application | ResponseFactory | Response
    {
        $registerData = $request->validated();
        $response = $this->authService->createUser($registerData);
        return response($response,201);
    }
    public function login(LoginRequest $request) : JsonResponse
    {
        $loginData = $request->validated();
        $user = $this->userRepository->getByEmail($loginData['email']);
        $response=$this->authService->checkUser($user,$loginData);
        return response()->json($response,400);
    }
    public function logout(Request $request) : JsonResponse
    {
        if ($request->user()) {
        auth('sanctum')->user()->tokens()->delete();
        }
        return response()->json(['message' => 'Logged out'], 200);
    }

}
