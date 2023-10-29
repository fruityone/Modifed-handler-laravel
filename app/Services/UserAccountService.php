<?php

namespace App\Services;

use App\Models\User;

/**
 * Class UserAccountService.
 */
class UserAccountService
{
    /**
     * @param $id
     * @param $newEmail
     * @return \Illuminate\Http\JsonResponse|void
     *
     */
    public function updateUserEmail($id,$newEmail)
    {
        try{
        User::where('id',$id)->update([
            'email' => $newEmail,
        ]);
    }
    catch (ConnectionException $e) {
        Log::error('Email update failed: '. $e->getMessage());
        return response()->json(['error' => 'Failed to update email. Please try again later.'], 500);
    }

}
    public function updateUserPassword($user)
    {
        try{
        $user->update(['password' => bcrypt('password')]);
    }
    catch (ConnectionException $e) {
        Log::error('Password update failed: '. $e->getMessage());
        return response()->json(['error' => 'Failed to update password. Please try again later.'], 500);
    }
    }
}
