<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Movie;

class ImageUploadRequest extends FormRequest
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
        $movies_ids = Movie::pluck('id');   
        return [
            'image' => ['required', 'mimetypes:image/jpg,image/png,image/jpeg'],
            'movie_id' => ['required',Rule::in($movies_ids)]
        ];
    }
}
