<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsRequest extends FormRequest
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
        return [
            'title*.en'          => 'required|max:255',
            'title*.ar'          => 'required|max:255',
            'small_description*.en'          => 'required|max:255',
            'small_description*.ar'          => 'required|max:255',
            'content*.en'          => 'required',
            'content*.ar'          => 'required',
            'image'        => 'required|mimes:jpg,jpeg,bmp,png',
            'banner'        => 'required|mimes:jpg,jpeg,bmp,png',

        ];

    }
}
