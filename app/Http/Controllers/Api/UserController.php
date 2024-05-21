<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\BookList;
use App\Models\Friend;
use App\Models\User;
use App\Models\UserList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return new UserCollection($users);
    }

    public function show($id)
    {
        $publi = User::where('id', $id)->first();
        return new UserResource($publi);
    }

    public function delete($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'No se ha encontrado el usuario'], 404);
        }
        $friends = Friend::where('id_user', $id)->orWhere('id_friend', $id);
        $friends->delete();

        BookList::whereIn('id_list', function ($query) use ($id) {
            $query->select('id')->from('user_lists')->where('id_user', $id);
        })->delete();

        // Eliminar registros relacionados en la tabla user_lists
        UserList::where('id_user', $id)->delete();


        $user->delete();

        return response()->json([
            'message' => 'El usuario con id:' . $id . ' ha sido borrada con éxito',
            'data' => $id
        ], 200);
    }

    public function checkEmail($email){
        $user = User::where('email', $email)->first();
        return $user !== null;
    }

    public static function register(Request $request)
    {
        $user = new User();
        $user->name = $request->get('name');
        $user->surname = $request->get('surname');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->rol = $request->get('rol');
        $user->pic = $request->get('pic');
        $user->save();

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json(['token' => $token, 'user' => $user], 201);
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::where('id', $id)->first();
        $user->name = $request->get('name');
        $user->surname = $request->get('surname');
        if($request->get('email')){
            $user->email = $request->get('email');
        }
        if($request->get('password') != '' ){
            $user->password = Hash::make($request->get('password'));
        }
        if ($request->hasFile('pic')) {
            // Delete the old picture if it exists
            if ($user->pic) {
                Storage::delete($user->pic);
            }
            $path =  $request->file('pic')->store('public/profile_pics');
            // Store the new picture
            $user->pic = Storage::url($path);
        }
        $user->save();
        return new UserResource($user);
    }

    public function getByEmail($email)
    {
        $user = User::where('email',$email)->first();

        $data = new \stdClass();

        foreach ($user->getAttributes() as $key => $value) {
            if ($key === 'password') {
                continue;
            }
            $data->$key = $value ?? '';
        }

        return $data;
    }
}
