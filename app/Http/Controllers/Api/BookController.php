<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Models\Author;
use App\Models\Book;
use App\Models\Publisher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function store(BookRequest $request)
    {
        $book = new Book();
        $book->name = $request->get('name');
        $book->id_author = $request->get('author');
        $book->id_publisher = $request->get('publisher');
        $book->description = $request->get('description');
        $book->sales = $request->get('sales');
        $book->publication = $request->get('publication');
        $book->genres = $request->get('genres');
        $book->save();
        return new BookResource($book);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $book = Book::with('author', 'publisher')->find($id);
        return new BookResource($book);
    }

    public function getBookByAuthor($id_author)
    {
        $book = Book::where('id_author', $id_author)->get();
        return new BookCollection($book);
    }

    public function getBookByPubisher($id_publisher)
    {
        $book = Book::where('id_publisher', $id_publisher)->get();
        return new BookCollection($book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookRequest $request, $id)
    {
        $book = Book::findOfFail($id);
        $book->name = $request->get('name');
        $book->id_author = $request->get('author');
        $book->id_publisher = $request->get('publisher');
        $book->description = $request->get('description');
        $book->sales = $request->get('sales');
        $book->publication = $request->get('publication');
        $book->genres = $request->get('genres');
        $book->save();
        return new BookResource($book);
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

    public function search(Request $request)
    {
        $query = $request->input('query');

        $books = Book::where('name', 'like', "%$query%")
            ->orWhereHas('author', function ($authorQuery) use ($query) {
                $authorQuery->whereHas('user', function ($userQuery) use ($query) {
                    $userQuery->where('name', 'like', "%$query%");
                });
            })
            ->orWhereHas('publisher', function ($publisherQuery) use ($query) {
                $publisherQuery->whereHas('user', function ($userQuery) use ($query) {
                    $userQuery->where('name', 'like', "%$query%");
                });
            })
            ->paginate(10);
        return new BookCollection($books);
    }
}
