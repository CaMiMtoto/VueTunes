<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'release_date',
        'cover_image',
        'description',
    ];

    protected $casts = [
        'release_date' => 'datetime',
    ];

    protected $appends = [
        'cover_image',
        'release_date',
    ];

    public function songs(): HasMany
    {
        return $this->hasMany(Song::class);
    }

    // cover_image attribute
    public function getCoverImageAttribute($value): string
    {
        return $value ? asset('storage/' . $value) : '';
    }

    public function getReleaseDateAttribute($value): string
    {
        return $value ? $value->format('d/m/Y') : '';
    }


}
