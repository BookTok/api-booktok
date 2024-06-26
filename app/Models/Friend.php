<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_friend',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function friend()
    {
        return $this->belongsTo(User::class, 'id_friend');
    }
}
