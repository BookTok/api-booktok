<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserList extends Model
{
    protected $table = 'user_lists';
    use HasFactory;

    protected $fillable = [
        'id_user',
        'name',
        'private',
    ];

    // Definición de la relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
