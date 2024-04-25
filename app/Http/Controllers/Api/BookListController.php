<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookListCollection;
use App\Http\Resources\BookListResource;
use App\Models\BookList;
use Illuminate\Http\Request;

class BookListController extends Controller
{
    public function index()
    {
        $bookLists = BookList::all();
        return new BookListCollection($bookLists);
    }

    public function show($id)
    {
        $bookList = BookList::findOrFail($id);
        return new BookListResource($bookList);
    }

    public function delete($id)
    {
        try {
            $bookList = BookList::findOrFail($id);
            $bookList->delete();
            return response()->json(['message' => 'La entrada de la tabla book_list ha sido eliminada correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'No se pudo eliminar la entrada de la tabla book_list'], 500);
        }
    }

    public function getListByUser($id)
    {
        $books = BookList::where('id_list', $id)->paginate(10);
        return new BookListCollection($books);
    }
}
