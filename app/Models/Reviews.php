<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'id_book',
        'id_user',
        'review',
        'rating',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function book()
    {
        return $this->belongsTo(Books::class, 'id_book');
    }
}
