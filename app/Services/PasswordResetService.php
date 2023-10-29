<?php

namespace App\Services;

use App\Models\PasswordReset;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Hash;

/**
 * Class PasswordResetService.
 */
class PasswordResetService
{
    public function updateOrInsertPasswordReset($email,$token)
    {
        try{
        PasswordReset::updateOrInsert([
            'email' => $email,
        ], [
            'email' => $email,
            'token' => Hash::make($token),
            'created_at' => now(),
        ]);
    }
        catch (ConnectionException $e) {
            Log::error('Password reset update failed: '. $e->getMessage());
            return response()->json(['error' => 'Failed to update password reset. Please try again later.'], 500);
        }
    }

}
