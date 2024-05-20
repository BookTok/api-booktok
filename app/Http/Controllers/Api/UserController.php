<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
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
        $user = User::findOrFail($id);
        $user->name = $request->get('name');
        $user->surname = $request->get('surname');
        if($request->get('email')){
            $user->email = $request->get('email');
        }
        if($request->get('password') != '' ){
            $user->password = Hash::make($request->get('password'));
        }
        if ($request->hasFile('pic')) {
            // Elimina la imagen anterior si existe
            if ($user->pic) {
                Storage::delete($user->pic);
            }
            // Almacena la nueva imagen y obtiene su nombre original
            $path = $request->file('pic')->store('profile_pics', 'public');
            $user->pic = $request->file('pic')->getClientOriginalName();
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
