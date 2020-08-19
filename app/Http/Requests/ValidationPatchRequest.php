<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Votes;
use Illuminate\Support\Facades\Route;

class ValidationPatchRequest extends FormRequest
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
        $enum = ['like', 'dislike', 'none'];
        $votes = Votes::get(['id'])->toArray();
        $votes_ids = [];
        foreach($votes as $vote)
        {
            array_push($votes_ids,$vote['id']);
        }
        return [
            'vote' => ['required', Rule::in($enum)],
            'id' => [Rule::in($votes_ids)]
        ];
    }

    public function messages()
    {
        return [
            'vote.required' => 'A status is required',
            'vote.in' => 'Vote doesnt exist',
            'id.in' => 'Vote doesnt exit',
        ];
    }

    public function validationData()
    {
        return array_merge($this->request->all(), [
            'id' => Route::input('id'),
        ]);
    }
}
