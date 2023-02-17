<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Song extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'length',
        'file',
        'description',
        'genre_id',
        'album_id',
    ];

    protected $appends = [
        'duration',
        'cover_image_url',
        'file_url',
    ];


    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }

    // cover_image attribute
    public function getCoverImageUrlAttribute($value): string
    {
        return $value ? asset('storage/' . $value) : '';
    }

    // length attribute

    public function getDurationAttribute($value): string
    {
        $minutes = floor($value / 60);
        $seconds = $value % 60;

        return sprintf('%02d:%02d', $minutes, $seconds);
    }

    // file attribute

    public function getFileUrlAttribute($value): string
    {
        return $value ? asset('storage/' . $value) : '';
    }

}
