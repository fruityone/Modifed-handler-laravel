<?php

namespace App\Interfaces;

interface PasswordResetInterface
{
    public function getPasswordResetDetails($email) : mixed;

}
