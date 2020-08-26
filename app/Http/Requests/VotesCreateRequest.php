<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;
use App\Movie;
use Illuminate\Validation\Rule;


class VotesCreateRequest extends FormRequest
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
        $enum = ['like', 'dislike'];
        $movies_ids = Movie::pluck('id');
        $users_ids = User::pluck('id');
        return [
            'vote' => ['required', Rule::in($enum)],
            'movies_id' => ['required',Rule::in($movies_ids)],
            'user_id' => ['required',Rule::in($users_ids)]

        ];
    }

    public function messages()
    {
        return [
            'vote.required' => 'A vote is required',
            'vote.in' => 'That type of vote doesnt exist',
            'movies_id.in' => 'Movie doesnt exit',
            'user_id.in' => 'User doesnt exit',
        ];
    }
}
