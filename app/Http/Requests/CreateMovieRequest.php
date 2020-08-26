<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Genre;

class CreateMovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $genre_ids = Genre::pluck('id');

        return [
            'genre_id' => ['required',Rule::in($genre_ids)],
            'title' => ['required'],
            'description' => ['required']
        ];
    }
}
