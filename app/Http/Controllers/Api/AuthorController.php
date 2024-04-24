<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PharIo\Manifest\AuthorCollection;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Auth::paginate(10);
        return new AuthorResource($books);
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
        $book = Author::find($id);
        return new AuthorResource($book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $books)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $book)
    {
        $book->delete();
        return response()->json(['message' => 'Libro eliminado correctamente']);
    }

    public function getByEmail($email)
    {
        $user = User::where('email',$email)->first();
        $author = Author::where('id_user', $user->id)->first();

        $data = new \stdClass();
        foreach ($author->getAttributes() as $key => $value) {
            $data->$key = $value ?? '';
        }

        foreach ($user->getAttributes() as $key => $value) {
            if ($key === 'password') {
                continue;
            }
            $data->$key = $value ?? '';
        }

        return $data;
    }
}
