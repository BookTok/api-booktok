<?php

namespace App\Http\Resources;

use App\Models\UserList;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $list = UserList::where('id', $this->id_list)->first();
        return [
            'id' => $this->id,
            'id_book'=> new BookResource($this->book),
            'id_list'=> new UserListResource($list),
        ];
    }
}
