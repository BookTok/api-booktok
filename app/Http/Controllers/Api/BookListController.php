<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookListRequest;
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

    public function delete($id_list, $id_book)
    {
        try {
            $bookList = BookList::where('id_list', $id_list)
            ->where('id_book', $id_book)->first();
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

    public function storeBook(BookListRequest $request){
        $list = new BookList();
        $list->id_book = $request->get('id_book');
        $list->id_list = $request->get('id_list');
        $list->save();
        return new BookListResource($list);
    }
}
