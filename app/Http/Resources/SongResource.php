<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SongResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param mixed $request
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'length' => $this->length,
            'file' => $this->file,
            'genre_id' => $this->genre_id,
            'album_id' => $this->album_id,
            'duration' => $this->duration,
            'file_url' => $this->file_url,
            'album' => AlbumResource::make($this->whenLoaded('album')),
            'genre' => GenreResource::make($this->whenLoaded('genre')),
        ];
    }
}
