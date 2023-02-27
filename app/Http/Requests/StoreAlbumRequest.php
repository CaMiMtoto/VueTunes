<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAlbumRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255', 'unique:albums'],
            'release_date' => ['required', 'date'],
            'cover_image' => ['image', 'max:1024', 'mimes:jpeg,png,jpg,gif,svg,webp'],
            'description' => ['required', 'string'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'A title is required',
            'title.unique' => 'This title already exists',
            'release_date.required' => 'A release date is required',
            'cover_image.required' => 'A cover image is required',
            'description.required' => 'A description is required',
        ];
    }
}
