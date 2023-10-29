<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * Class AuthService.
 */
class AuthService
{
    /**
     * @param $validatedData
     * @return array
     */
    public function createUser($validatedData) : array
    {
        $user = User::create([
            'name' => $validatedData['name'],
            'lastname' => $validatedData['lastname'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);
        $token = $user->createToken('myapptoken')->plainTextToken;
        $createdUser = ['user'=>$user, 'token'=>$token];
        return $createdUser;
    }
    public function checkUser($user,$loginData)
    {
        if(!$user || !Hash::check(($loginData['password']),$user->password))
        {
            return ['message' => 'Bad credentials'];
        }
        $token = $user->createToken('myapptoken')->plainTextToken;
        $authData = ['user'=>$user,'token'=>$token];
        return $authData;
    }
}
