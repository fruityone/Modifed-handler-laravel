<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSettings extends Model
{
    use HasFactory;
    protected $fillable =['email_change_code','email_change_expire_date','user_id','preferred_email'];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
