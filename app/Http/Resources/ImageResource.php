<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => $this->typeModel->title,
            'title' => $this->title,
            'path' => env('APP_URL') . '/storage/images/' . $this->id . '/' . $this->title,
        ];
    }
}
