<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookStatusCollection;
use App\Http\Resources\BookStatusResource;
use App\Models\Book;
use App\Models\BookStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookStatusController extends Controller
{
    public function index()
    {
        $bookStatus = BookStatus::all();
        return new BookStatusCollection($bookStatus);
    }

    public function show($id)
    {
        $bookList = BookStatus::findOrFail($id);
        return new BookStatusResource($bookList);
    }

    public function delete($id)
    {
        try {
            $bookList = BookStatus::findOrFail($id);
            $bookList->delete();
            return response()->json(['message' => 'La entrada de la tabla book_list ha sido eliminada correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'No se pudo eliminar la entrada de la tabla book_list'], 500);
        }
    }

    public function getBookStatusByUser($id)
    {
        $books = BookStatus::where('id_user', $id)->paginate(10);
        return new BookStatusCollection($books);
    }

    public function getBookStatusByUserAndStatus($id, $status)
    {
        $books = BookStatus::where('id_user', $id)
            ->where('status', $status)
            ->paginate(10);
        return new BookStatusCollection($books);
    }

    public function store(Request $request)
    {
        $book_status = new BookStatus();

    }

    public function update(Request $request, $id_book, $id_user)
    {
        $book = BookStatus::where('id_book', $id_book)
            ->where('id_user', $id_user)->first();
        $book->pages = $request->get('pages');
        $book->updated_at = Carbon::now();
        $book->save();
        return new BookStatusResource($book);
    }

    public function updateStatus(Request $request, $id_book, $id_user)
    {
        $book = BookStatus::where('id_book', $id_book)
            ->where('id_user', $id_user)->first();

        // Verificar si el valor de 'status' está presente y es válido
        $status = $request->get('status');
        if (!in_array($status, ['READ', 'READING', 'WISH'])) {
            return response()->json(['error' => 'Invalid status value'], 400);
        }

        $book->status = $status;

        if ($status == 'READ') {
            $book_read = Book::where('id', $id_book)->first();
            $book->pages = $book_read->pages;
        } else {
            $book->pages = null;
        }

        $book->updated_at = Carbon::now();
        $book->save();

        return new BookStatusResource($book);
    }
}
