<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCode extends Model
{
    public $timestamps = false;
    // especificat perque no utilitzem el id per defecte
    protected $primaryKey = 'user_fk'; 
    public $incrementing = false; 
    protected $fillable = ['user_id', 'code', 'expiration'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}