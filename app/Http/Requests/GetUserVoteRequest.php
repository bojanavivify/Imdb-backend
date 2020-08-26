<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Movie;
use App\User;
use Illuminate\Support\Facades\Route;

class GetUserVoteRequest extends FormRequest
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
        $users_ids = User::pluck('id');
        return [
            'movie_id' => [Rule::in($movies_ids)],
            'user_id' => [Rule::in($users_ids)]

        ];
    }
    public function messages()
    {
        return [
            'movie_id.in' => 'Movie doesnt exit',
            'user_id.in' => 'User doesnt exit',

        ];
    }

    public function validationData()
    {
        return array_merge($this->request->all(), [
            'movie_id' => Route::input('movie_id'),
            'user_id' => Route::input('user_id'),
        ]);
    }
}
