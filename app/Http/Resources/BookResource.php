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
            'id'=> $this->id,
            'title'=> $this->title,
            'author' => new AuthorResource($this->whenLoaded('author')), //o whenLoaded so retorna se estiver carregado o with()
            'summary'=> $this->summary,
            'genre' => new GenreResource($this->whenLoaded('genre')),
            'reviews' => ReviewResource::collection($this->whenLoaded('review')), // Transforma a coleção de reviews carregada em uma lista de dicionários formatados com ReviewResource
            
        ];
    }
}
