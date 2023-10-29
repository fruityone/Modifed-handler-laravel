<?php

namespace App\Repositories;



use App\Interfaces\UserSettingsInterface;
use App\Models\UserSettings;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class UserSettingsRepository implements UserSettingsInterface
{
    public function getExpiredEmailUsers() : mixed
    {
        return UserSettings::where('email_change_expire_date', '<', Carbon::now())->get();
    }
    public function getUserSettingsById($userId) : mixed
    {
        return UserSettings::where('user_id', $userId)->first();
    }
}
