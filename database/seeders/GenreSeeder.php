<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $musicGenres = [
            'Alternative',
            'Blues',
            'Classical',
            'Country',
            'Dance',
            'Electronic',
            'Folk',
            'Hip Hop',
            'Indie',
            'Jazz',
            'Latin',
            'Metal',
            'Pop',
            'Punk',
            'R&B',
            'Reggae',
            'Rock',
            'Soul',
            'World',
        ];

        if (Genre::query()->count() > 0) {
            return;
        }

        foreach ($musicGenres as $genre) {
            Genre::query()
                ->create([
                    'name' => $genre,
                    'slug' => Str::slug($genre) . '-' . Str::random(5),
                ]);
        }
    }
}
