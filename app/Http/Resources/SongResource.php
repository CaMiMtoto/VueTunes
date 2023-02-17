<?php

namespace App\Http\Resources;

class SongResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  mixed  $request
     * @return array<int|string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'length' => $this->length,
            'file' => $this->file,
            'description' => $this->description,
            'genre_id' => $this->genre_id,
            'album_id' => $this->album_id,
            'duration' => $this->duration,
            'cover_image_url' => $this->cover_image_url,
            'file_url' => $this->file_url,
        ];
    }
}
