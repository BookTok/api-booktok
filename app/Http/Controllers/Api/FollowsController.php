<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FollowRequest;
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

    public function show($id_user)
    {
        $follow = Follow::where('id_user', $id_user)->get();
        return new FollowsCollection($follow);
    }

    public function unfollowAuthor($id_user, $id_follow)
    {
        try {
            $follow = Follow::where('id_user', $id_user)
            ->where('id_author', $id_follow)->first();
            if ($follow->id_publisher != null) {
                $follow->id_author = null;
                $follow->save();
            } else{
                $follow->delete();
            }
            return response()->json(['message' => 'Habeis dejado de seguir a este autor/a'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'No se pudo dejar se seguir correctamente'], 500);
        }
    }

    public function unfollowPublisher($id_user, $id_follow)
    {
        try {
            $follow = Follow::where('id_user', $id_user)
                ->where('id_publisher', $id_follow)->first();
            if ($follow->id_author != null) {
                $follow->id_publisher = null;
                $follow->save();
            } else{
                $follow->delete();
            }
            return response()->json(['message' => 'Habeis dejado de seguir a esta editorial'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'No se pudo dejar se seguir correctamente'], 500);
        }
    }

    public function store(Request $request){
        $follow = new Follow();
        $follow->id_user = $request->get('id_user');
        if ($request->get('id_publisher') == 0) {
            $follow->id_author = $request->get('id_author');
            $follow->id_publisher = null;
        }
        if ($request->get('id_author') == 0){
            $follow->id_publisher = $request->get('id_publisher');
            $follow->id_author = null;
        }
        $follow->save();
        return new FollowsResource($follow);
    }

    public function areFollow($id_user, $id_author, $id_publisher)
    {
        if ($id_author == 0) {
            $friend = Follow::where('id_user', $id_user)->
            where('id_publisher', $id_publisher)->where('id_author', null)->first();
            if ($friend == null) {
                return response()->json(['bool' => '0']);
            }
            return response()->json(['bool' => '1']);
        }
        if ($id_publisher == 0) {
            $friend = Follow::where('id_user', $id_user)->
            where('id_author', $id_author)->where('id_publisher', null)->first();
            if ($friend == null) {
                return response()->json(['bool' => '0']);
            }
            return response()->json(['bool' => '1']);
        }
        return response()->json(['bool' => '0']);
    }
}
