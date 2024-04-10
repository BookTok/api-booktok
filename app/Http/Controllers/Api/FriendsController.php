<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FollowsCollection;
use App\Http\Resources\FollowsResource;
use App\Models\Friend;
use Illuminate\Http\Request;

class FriendsController extends Controller
{
    public function index()
    {
        $friends = Friend::all();
        return new FollowsCollection($friends);
    }

    public function show($id)
    {
        $friend = Friend::findOrFail($id);
        return new FollowsResource($friend);
    }

    public function delete($id)
    {
        try {
            $friend = Friend::findOrFail($id);
            $friend->delete();
            return response()->json(['message' => 'La entrada de la tabla book_list ha sido eliminada correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'No se pudo eliminar la entrada de la tabla book_list'], 500);
        }
    }
}
