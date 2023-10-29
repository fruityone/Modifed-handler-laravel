<?php

namespace App\Interfaces;

use App\Models\UserSettings;

interface UserSettingsInterface
{
    public function getExpiredEmailUsers() : mixed;
    public function getUserSettingsById($userId) : mixed;

}
