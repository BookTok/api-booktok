<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return new UserCollection($users);
    }

    public function show($id)
    {
        $publi = User::with('user')->find($id);
        return new UserResource($publi);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'Usuario eliminado correctamente']);
    }
}
