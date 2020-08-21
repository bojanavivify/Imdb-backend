<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Movie;
use Illuminate\Support\Facades\Route;

class CheckMovieExistPathRequest extends FormRequest
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
        $movies = Movie::get(['id'])->toArray();
        $movies_ids = [];
        foreach($movies as $movie)
        {
            array_push($movies_ids,$movie['id']);
        }
        return [
            'id' => [Rule::in($movies_ids)]
        ];
    }
    public function messages()
    {
        return [
            'id.in' => 'Movie doesnt exit',
        ];
    }

    public function validationData()
    {
        return array_merge($this->request->all(), [
            'id' => Route::input('id'),
        ]);
    }
}
