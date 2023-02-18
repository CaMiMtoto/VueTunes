<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Slugify
{
    // add slug to model before saving
    public static function bootSlugify(): void
    {
        static::creating(function ($model) {
            $model->slug = Str::slug($model->name).'-'.uniqid();
        });
    }

}
