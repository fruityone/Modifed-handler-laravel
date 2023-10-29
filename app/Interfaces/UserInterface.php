<?php

namespace App\Interfaces;

use App\Models\User;

interface UserInterface
{
    public function getByEmail($email) : User | null;

}
