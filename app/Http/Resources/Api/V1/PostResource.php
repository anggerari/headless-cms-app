<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PostResource extends JsonResource
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
            'content' => $this->content,
            'excerpt' => $this->excerpt,
            // Construct the full, public URL for the image
            'image_url' => $this->whenNotNull($this->image ? Storage::url($this->image) : null),
            // The 'blocks' JSON column is included if it's not null
            'blocks' => $this->whenNotNull($this->blocks),
            'published_at' => $this->published_at?->toIso8601String(), // Format date to a standard

            // === Relationships ===
            // Here we embed the related data using their own resources.
            // This is a key best practice for clean, nested JSON.
            'author' => new UserResource($this->whenLoaded('user')),
            'categories' => CategoryResource::collection($this->whenLoaded('categories')),
        ];
    }
}
