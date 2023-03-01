<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Genre;
use App\Models\Song;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $totalSongs = Song::count();
        $totalAlbums = Album::count();
        $totalGenres = Genre::count();

        return [
            'total_songs' => $totalSongs,
            'total_albums' => $totalAlbums,
            'total_genres' => $totalGenres,
        ];

    }
}
