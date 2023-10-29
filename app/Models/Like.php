<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    public function blogs()
    {
        return $this->belongsToMany(Blog::class);
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
