<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Models\BookList;
use App\Models\BookStatus;
use App\Models\Review;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::paginate(10);
        return new BookCollection($books);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $book = Book::with('author', 'publisher')->find($id);
        return new BookResource($book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $books)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json(['message' => 'Libro eliminado correctamente']);
    }

    public function booksByGenre($genre){
        $books = Book::where('genres', $genre)->paginate(10);
        return new BookCollection($books);
    }
}
