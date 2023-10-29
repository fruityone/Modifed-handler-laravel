<?php

namespace App\Services;

use App\Models\UserSettings;
use Carbon\Carbon;
use Illuminate\Http\Client\ConnectionException;

/**
 * Class UserSettingsService.
 */
class UserSettingsService
{
    public function updateOrInsertEmailCode($verificationCode,$email)
    {
        try {
            UserSettings::updateOrInsert([
                'user_id' => auth('sanctum')->id(),
            ], [
                'preferred_email' => $email,
                'email_change_code' => bcrypt($verificationCode),
                'email_change_expire_date' => Carbon::now()->addMinutes(30),
            ]);
        }
        catch (ConnectionException $e) {
            Log::error('Email code update failed: '. $e->getMessage());
            return response()->json(['error' => 'Failed to update email code. Please try again later.'], 500);
        }
    }
    public function resetEmailUpdateSettings($userSettings){
        try{
        $userSettings->update([
            'email_change_code' => null,
            'email_change_expire_date' => null,
            'preferred_email' => null,
        ]);
    }
    catch (ConnectionException $e) {
        Log::error('Email code reset failed: '. $e->getMessage());
        return response()->json(['error' => 'Failed to reset email code. Please try again later.'], 500);
    }
    }

}
