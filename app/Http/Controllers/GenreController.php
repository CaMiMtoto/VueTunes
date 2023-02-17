<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGenreRequest;
use App\Http\Requests\UpdateGenreRequest;
use App\Http\Resources\GenreResource;
use App\Models\Genre;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class GenreController extends Controller
{

    public function index(): JsonResponse
    {
        $genres = Genre::all();
        return GenreResource::collection($genres)
            ->response();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGenreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $genre = Genre::query()
            ->create($data);
        return GenreResource::make($genre)
            ->response();
    }

    /**
     * Display the specified resource.
     */
    public function show(Genre $genre): Response
    {
        return GenreResource::make($genre)
            ->response();
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGenreRequest $request, Genre $genre): RedirectResponse
    {
        $data = $request->validated();

        $genre->update($data);
        return GenreResource::make($genre)
            ->response();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre): Response
    {
        $genre->delete();
        return \response()->noContent();
    }
}
