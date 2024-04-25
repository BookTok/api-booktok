<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookStatusCollection;
use App\Http\Resources\BookStatusResource;
use App\Models\BookStatus;
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
}
