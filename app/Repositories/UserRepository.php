<?php

namespace App\Repositories;


use App\Interfaces\UserInterface;
use App\Models\User;

/**
 * Class UserRepository.
 */
class UserRepository implements UserInterface
{
    public function getByEmail($email) : User | null
    {
        return  User::where('email',$email)->first();
    }
}
