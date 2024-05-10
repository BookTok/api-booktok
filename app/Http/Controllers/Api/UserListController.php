<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserListRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserListCollection;
use App\Http\Resources\UserListResource;
use App\Models\User;
use App\Models\UserList;
use Illuminate\Http\Request;

class UserListController extends Controller
{
    public function index()
    {
        $userList = UserList::all();
        return new UserListCollection($userList);
    }

    public function show($id)
    {
        $userList = UserList::findOrFail($id);
        return new UserListResource($userList);
    }

    public function delete($id)
    {
        try {
            $userList = UserList::findOrFail($id);
            $userList->delete();
            return response()->json(['message' => 'La entrada de la tabla book_list ha sido eliminada correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'No se pudo eliminar la entrada de la tabla book_list'], 500);
        }
    }

    public function getUserListByUser($id)
    {
        $books = UserList::where('id_user', $id)->paginate(10);
        return new UserListCollection($books);
    }

    public function store(UserListRequest $request){
        $list = new UserList();
        $list->id_user = $request->get('id_user');
        $list->name = $request->get('name');
        $list->private = $request->get('private');
        $list->save();
        return new UserListResource($list);
    }

    public function update(UserListRequest $request, $id_user, $id_list){
        $list = UserList::where ('id_user', $id_user)
            ->where('id', $id_list)->first();
        $list->id_user = $request->get('id_user');
        $list->name = $request->get('name');
        $list->private = $request->get('private');
        $list->save();
        return new UserListResource($list);
    }
}
