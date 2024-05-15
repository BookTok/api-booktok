<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FriendRequest;
use App\Http\Resources\FollowsCollection;
use App\Http\Resources\FollowsResource;
use App\Http\Resources\FriendsCollection;
use App\Http\Resources\FriendsResource;
use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;

class FriendsController extends Controller
{
    public function index()
    {
        $friends = Friend::all();
        return new FriendsCollection($friends);
    }

    public function show($id_user)
    {
        $friend = Friend::where('id_user', $id_user)->get();
        return new FriendsCollection($friend);
    }

    public function delete($id_user, $id_friend)
    {
        try {
            $friend = Friend::where('id_user', $id_user)
            ->where('id_friend', $id_friend)->first();
            $friend->delete();
            return response()->json(['message' => 'Habeis dejado de ser amigos'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'No se pudo dejar se seguir correctamente'], 500);
        }
    }

    public function store(FriendRequest $request)
    {
        $friend = new Friend();
        $friend->id_user = $request->get('id_user');
        $friend->id_friend = $request->get('id_friend');
        $friend->save();
        return new FriendsResource($friend);
    }
}
