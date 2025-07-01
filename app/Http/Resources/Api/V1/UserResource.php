<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // We only expose the user's ID and name.
        // This prevents leaking sensitive info like email addresses.
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
