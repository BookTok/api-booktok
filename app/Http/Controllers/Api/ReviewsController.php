<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookCollection;
use App\Http\Resources\ReviewCollection;
use App\Http\Resources\ReviewsResource;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewsController extends Controller
{
    public function index()
    {
        $reviews = Review::paginate(10);
        return new ReviewCollection($reviews);
    }

    public function show($id)
    {
        // Encuentra todas las revisiones que correspondan al ID del libro
        $reviews = Review::where('id_book', $id)->paginate(10);

        // Devuelve las revisiones como un recurso
        return new ReviewCollection($reviews);
    }

    public function getAverageRating($id)
    {
        // Consulta para calcular el promedio del rating para todas las revisiones
        $averageRating = Review::where('id_book', $id)->avg('rating');

        // Redondear el promedio a 1 decimal
        $roundedAverageRating = round($averageRating, 1);

        // Devolver el promedio como JSON
        return response()->json(['total' => $roundedAverageRating]);
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

    public function getBestRating()
    {
        $books = DB::table('books')
            ->select('books.*', DB::raw('(SELECT ROUND(AVG(rating), 1) FROM reviews WHERE rating BETWEEN 3 AND 5 AND id_book = books.id) as rating_average'))
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('reviews')
                    ->whereRaw('rating BETWEEN 3 AND 5')
                    ->whereRaw('id_book = books.id');
            })
            ->paginate(10);

        return json_encode($books);
    }
}
