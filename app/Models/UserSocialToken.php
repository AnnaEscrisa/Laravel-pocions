<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSocialToken extends Model
{
    public $timestamps = false;
    // especificat perque no utilitzem el id per defecte
    protected $primaryKey = 'user_fk'; 
    public $incrementing = false; 
    protected $keyType = 'string';
    protected $fillable = ['user_fk', 'token', 'social', 'social_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_fk');
    }
}