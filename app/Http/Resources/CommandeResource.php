<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommandeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id' => $this->id,
            'slug' => $this->slug,
            'statut'=>$this->statut,
            'prix'=>$this->prix,
            'paiement'=>$this->paiement,
            'date_commande'=>$this->date_commande->translatedFormat('d F Y'),
            'date_livraison'=>$this->date_livraison->translatedFormat('d F Y'),
            'note'=>$this->note,
            'student'=> StudentsResource::collection($this->whenLoaded('student'))
        ];
    }
}
