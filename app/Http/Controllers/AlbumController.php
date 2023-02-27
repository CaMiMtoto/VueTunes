<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAlbumRequest;
use App\Http\Requests\UpdateAlbumRequest;
use App\Http\Resources\AlbumResource;
use App\Models\Album;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $column = request('order', 'id');
        $direction = request('dir', 'desc');
        $perPage = request()->input('per_page', 10);

        $resource = Album::query()
            ->withCount('songs')
            ->orderBy($column, $direction)
            ->paginate($perPage);

        return AlbumResource::collection($resource)
            ->response();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAlbumRequest $request)
    {
        $data = $request->validated();

        $image = $request->file('cover_image');
        if (!empty($image)) {
            $path = $image->store(Album::COVER_IMAGE_PATH);
            $fileName = basename($path);
            $data['cover_image'] = $fileName;
        }
        $data['slug'] = Str::slug($data['title']) . '-' . uniqid();

        $album = Album::create($data);

        return AlbumResource::make($album)
            ->response();
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        return AlbumResource::make($album)
            ->response();
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAlbumRequest $request, Album $album)
    {
        $data = $request->validated();

        $image = $request->file('cover_image');
        if (!empty($image)) {
            $dir = Album::COVER_IMAGE_PATH;
            $oldImage = $album->cover_image;
            if ($oldImage) {
                $oldImagePath = $dir . '/' . $oldImage;
                if (Storage::exists($oldImagePath)) {
                    Storage::delete($oldImagePath);
                }
            }

            $path = $image->store($dir);
            $fileName = basename($path);
            $data['cover_image'] = $fileName;
        } else {
            $data['cover_image'] = $album->cover_image;
        }

        $album->update($data);

        return AlbumResource::make($album)
            ->response();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        // Delete the cover image
        $dir = Album::COVER_IMAGE_PATH;
        $oldImage = $album->cover_image;
        if ($oldImage) {
            $oldImagePath = $dir . '/' . $oldImage;
            if (Storage::exists($oldImagePath)) {
                Storage::delete($oldImagePath);
            }
        }
        $album->delete();
        return AlbumResource::make($album)
            ->response();
    }
}
