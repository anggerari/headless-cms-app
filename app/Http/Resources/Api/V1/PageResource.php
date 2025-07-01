<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
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
            'title' => $this->title,
            'slug' => $this->slug,
            'body' => $this->body,
            // The 'blocks' JSON column is included if it's not null
            'blocks' => $this->whenNotNull($this->blocks),
            'published_at' => $this->created_at->toIso8601String(), // Format date to a standard
        ];
    }
}
