<?php

namespace App\Http\Resources;

use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentsResource extends JsonResource
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
            'slug' => $this->slug,
            'name' => $this->name,
            'course' => $this->course,
            'email' => $this->email,
            'phone' => $this->phone,
            'commandes'=> CommandeResource::collection($this-> whenLoaded('commandes')),
        ];

    }
}
