<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PublisherCollection;
use App\Http\Resources\PublisherResource;
use App\Models\Publisher;
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

    public function destroy(Publisher $publi)
    {
        $publi->delete();
        return response()->json(['message' => 'Editorial eliminado correctamente']);
    }
}
