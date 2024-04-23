<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PublisherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $publisher = User::find($this->id_user);
        return [
            'id' => $this->id,
            'user'=>  new UserResource($publisher),
            'web'=> $this->web,
            'description'=> $this->description,
            'name'=> $this->user->name,
            'email'=> $this->user->email,
            'rol'=> $this->user->rol,
            'icon'=> $this->user->pic
        ];
    }
}
