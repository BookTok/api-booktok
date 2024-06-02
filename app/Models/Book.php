<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'name',
        'id_author',
        'id_publisher',
        'description',
        'sales',
        'publication',
        'genres',
        'pages'
    ];

    public function author()
    {
        return $this->belongsTo(Author::class, 'id_author');
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class, 'id_publisher');
    }
}
