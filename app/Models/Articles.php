<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Articles extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'titol',
        'cos',
        'imatge',
        'ingredients',
        'user_id',
    ];

    public function scopeWithUserName($query)
    {
        return $query->join('users', 'articles.user_id', '=', 'users.id')
            ->select([
                'articles.*',
                'users.name as user_name',
            ]);
    }
}
