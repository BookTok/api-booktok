<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'id_author' => $this->author->user->name,
            'id_publisher'=> $this->publisher->user->name,
            'description'=> $this->description,
            'sales'=> $this->sales,
            'publication'=> $this->publication,
            'genres'=> $this->genres
        ];
    }
}
