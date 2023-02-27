<?php

namespace App\Models;

use App\Traits\Slugify;
use Carbon\Carbon;
use Database\Factories\AlbumFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * App\Models\Album
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $release_date
 * @property string $cover_image
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Collection<int, Song> $songs
 * @property-read int|null $songs_count
 * @method static AlbumFactory factory($count = null, $state = [])
 * @method static Builder|Album newModelQuery()
 * @method static Builder|Album newQuery()
 * @method static Builder|Album query()
 * @method static Builder|Album whereCoverImage($value)
 * @method static Builder|Album whereCreatedAt($value)
 * @method static Builder|Album whereDescription($value)
 * @method static Builder|Album whereId($value)
 * @method static Builder|Album whereReleaseDate($value)
 * @method static Builder|Album whereSlug($value)
 * @method static Builder|Album whereTitle($value)
 * @method static Builder|Album whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Album extends Model
{
    use HasFactory;

    const COVER_IMAGE_PATH = 'albums/covers';

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
        'cover_image_url',
        'release_date',
    ];


    public function songs(): HasMany
    {
        return $this->hasMany(Song::class);
    }

    public static function bootSlugify(): void
    {
        static::creating(function ($model) {
            $model->slug = Str::slug($model->title) . '-' . uniqid();
        });
    }

    // cover_image attribute
    public function getCoverImageUrlAttribute(): string
    {
        return Storage::url(self::COVER_IMAGE_PATH . '/' . $this->attributes['cover_image']);
    }

    protected function releaseDate(): Attribute
    {
        return Attribute::make(
            get: fn( $value) => Carbon::parse($value)->format('Y-m-d'),
        );
    }




}
