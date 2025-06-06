<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'rating'=> $this->rating,
            'text'=> $this->text,
            'user_id'=> new UserResource($this->whenLoaded('users')),
            'book_id'=> new BookResource($this->whenLoaded('books')),
        ];
    }
}