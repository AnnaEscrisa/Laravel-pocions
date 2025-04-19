<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSocialToken extends Model
{
    protected $fillable = ['user_fk', 'token', 'social', 'social_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_fk');
    }
}