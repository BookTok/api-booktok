<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
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
        'genres'
    ];

    public function author()
    {
        return $this->belongsTo(Authors::class, 'id_author');
    }

    public function publisher()
    {
        return $this->belongsTo(Publishers::class, 'id_publisher');
    }
}
