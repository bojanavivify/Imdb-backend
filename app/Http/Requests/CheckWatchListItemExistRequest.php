<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\WatchListItem;
use Illuminate\Support\Facades\Route;

class CheckWatchListItemExistRequest extends FormRequest
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
        $list = WatchListItem::pluck('id');   
        return [
            'id' => [Rule::in($list)]
        ];
    }

    public function validationData()
    {
        return array_merge([
            'id' => Route::input('item'),
        ]);
    }
}
