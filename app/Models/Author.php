<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'web',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function books()
    {
        return $this->hasMany(Book::class, 'id_author');
    }
}
