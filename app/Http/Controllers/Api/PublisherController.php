<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PublisherRequest;
use App\Http\Resources\PublisherCollection;
use App\Http\Resources\PublisherResource;
use App\Models\Author;
use App\Models\Publisher;
use App\Models\User;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function index()
    {
        $users = Publisher::paginate(10);
        return new PublisherCollection($users);
    }

    public function show($id)
    {
        $publi = Publisher::with('user')->find($id);
        return new PublisherResource($publi);
    }

    public function findByUserId($id)
    {
        $pub = Publisher::where('id_user', $id)->first();
        return new PublisherResource($pub);
    }

    public function destroy(Publisher $publi)
    {
        $publi->delete();
        return response()->json(['message' => 'Editorial eliminado correctamente']);
    }

    public function getByEmail($email)
    {
        $user = User::where('email',$email)->first();
        $author = Publisher::where('id_user', $user->id)->first();

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

    public function store(PublisherRequest $request)
    {
        $userResponse = UserController::register($request);
        $user = $userResponse->getOriginalContent()['user'];
        $token = $userResponse->getOriginalContent()['token'];
        $publisher = new Publisher();
        $publisher->id_user = $user->id;
        $publisher->web  = $request->get('web');
        $publisher->description = $request->get('description');
        $publisher->save();
        return response()->json(['token' => $token], 201);
    }

    public function update(PublisherRequest $request, $id)
    {
        $userApi = new UserController();
        $userApi->update($request, $id);
        $publisher = Publisher::where('id_user', $id)->firstOrFail();
        $publisher->web  = $request->get('web');
        $publisher->description = $request->get('description');
        $publisher->save();
        return new PublisherResource($publisher);
    }
}

