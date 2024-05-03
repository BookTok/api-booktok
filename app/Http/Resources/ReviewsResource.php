<?php

namespace App\Http\Resources;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $book = Book::find($this->id_book);
        return [
            'id' => $this->id,
            'book'=> $book ? new BookResource($book) : null,
            'id_user'=> $this->user,
            'review'=> $this->review,
            'rating'=> $this->rating,
        ];
    }
}
