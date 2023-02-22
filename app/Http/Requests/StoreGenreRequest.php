<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreGenreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }


    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255',
                Rule::unique('genres', 'id')
                    ->ignore(request('id'), 'id')
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Genre name is required',
            'name.unique' => 'Genre name must be unique',
        ];
    }
}
