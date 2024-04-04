<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follows extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'id_author',
        'id_publisher'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function author()
    {
        return $this->belongsTo(Authors::class, 'id_author', 'id');
    }

    public function publisher()
    {
        return $this->belongsTo(Publishers::class, 'id_publisher', 'id');
    }
}
