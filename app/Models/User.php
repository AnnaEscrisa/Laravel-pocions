<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    public $timestamps = false;

    protected $fillable = [
        'name',
        'user',
        'email',
        'password',
        'isSocial',
        'isAdmin'
    ];

    protected $hidden = [
        'password',
    ];

    public function codes()
    {
        return $this->hasOne(UserCode::class, 'user_id');
    }

    public function socialTokens()
    {
        return $this->hasOne(UserSocialToken::class, 'user_fk');
    } 

    public function articles()
    {
        return $this->hasMany(Articles::class, 'user_id');
    }
}
