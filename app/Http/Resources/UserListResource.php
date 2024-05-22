<?php

namespace App\Http\Resources;

use App\Models\BookList;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserListResource extends JsonResource
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
            'id_user'=> $this->user,
            'name'=> $this->name,
            'private'=> $this->private,
        ];
    }
}
