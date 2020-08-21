<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Movie;
use App\User;

class CreateCommentRequest extends FormRequest
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
        $users = User::get(['id'])->toArray();
        $users_ids = [];
        foreach($users as $user)
        {
            array_push($users_ids,$user['id']);
        }
        return [
            'text' => ['required', 'max:500'],
            'movies_id' => ['required',Rule::in($movies_ids)],
            'user_id' => ['required',Rule::in($users_ids)]

        ];
    }

    public function messages()
    {
        return [
            'movie_id.in' => 'Movie doesnt exit',
            'user_id.in' => 'User doesnt exit',
        ];
    }
}
