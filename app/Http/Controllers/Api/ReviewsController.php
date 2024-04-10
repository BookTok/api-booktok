<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewCollection;
use App\Http\Resources\ReviewsResource;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function index()
    {
        $reviews = Review::all();
        return new ReviewCollection($reviews);
    }

    public function show($id)
    {
        $review = Review::findOrFail($id);
        return new ReviewsResource($review);
    }

    public function delete($id)
    {
        try {
            $review = Review::findOrFail($id);
            $review->delete();
            return response()->json(['message' => 'La entrada de la tabla book_list ha sido eliminada correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'No se pudo eliminar la entrada de la tabla book_list'], 500);
        }
    }
}
