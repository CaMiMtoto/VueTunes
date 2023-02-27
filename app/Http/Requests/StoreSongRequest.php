<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSongRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'length' => ['required', 'integer', 'min:1'],
            'file' => ['required', 'file', 'mimes:mp3,MP3', 'max:' . (10240 * 10)],
            'genre_id' => ['required', 'integer', 'exists:genres,id'],
            'album_id' => ['required', 'integer', 'exists:albums,id']
        ];
    }

    public function messages(): array
    {
        return [
            'file.max' => 'The file size must be less than 10MB.',
            'file.mimes' => 'The file must be an mp3 file. (mp3, MP3)',
            'genre_id.exists' => 'The genre does not exist.',
            'album_id.exists' => 'The album does not exist.',
            'genre_id.required' => 'The genre is required.',
            'album_id.required' => 'The album is required.'
        ];
    }
}
