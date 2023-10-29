<?php

namespace App\Repositories;

use App\Interfaces\PasswordResetInterface;
use App\Models\PasswordReset;

class PasswordResetRepository implements PasswordResetInterface
{

    public function getPasswordResetDetails($email) : mixed
    {
        return PasswordReset::where('email', $email)->first();
    }
}
