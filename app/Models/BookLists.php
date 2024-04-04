<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookLists extends Model
{
    protected $table = 'book_lists';
    use HasFactory;

    protected $fillable = [
        'id_book',
        'id_list',
    ];

    // Definición de la relación con el modelo Book
    public function book()
    {
        return $this->belongsTo(Books::class, 'id_book');
    }

    // Definición de la relación con el modelo UserList
    public function userList()
    {
        return $this->belongsTo(UserList::class, 'id_list');
    }
}
