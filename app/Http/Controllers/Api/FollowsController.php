<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FollowsCollection;
use App\Http\Resources\FollowsResource;
use App\Models\Follow;
use Illuminate\Http\Request;

class FollowsController extends Controller
{
    public function index()
    {
        $follows = Follow::all();
        return new FollowsCollection($follows);
    }

    public function show($id)
    {
        $follow = Follow::findOrFail($id);
        return new FollowsResource($follow);
    }

    public function delete($id)
    {
        try {
            $follow = Follow::findOrFail($id);
            $follow->delete();
            return response()->json(['message' => 'La entrada de la tabla book_list ha sido eliminada correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'No se pudo eliminar la entrada de la tabla book_list'], 500);
        }
    }
}
