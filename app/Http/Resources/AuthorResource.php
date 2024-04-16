<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
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
            'id_user'=> $this->id_user,
            'web'=> $this->web,
            'description'=> $this->description,
            'name'=> $this->user->name,
            'email'=> $this->user->email,
            'rol'=> $this->user->rol,
            'icon'=> $this->user->pic
        ];
    }
}
