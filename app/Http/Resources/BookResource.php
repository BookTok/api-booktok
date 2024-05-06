<?php

namespace App\Http\Resources;

use App\Models\Author;
use App\Models\Publisher;
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
        $author = Author::find($this->id_author);
        $publisher = Publisher::find($this->id_publisher);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'author' => new UserResource($author->user),
            'publisher'=> new UserResource($publisher->user),
            'description'=> $this->description,
            'sales'=> $this->sales,
            'publication'=> $this->publication,
            'genres'=> $this->genres,
            'pic' => $this->pic,
            'pages' => $this->pages,
        ];
    }
}
