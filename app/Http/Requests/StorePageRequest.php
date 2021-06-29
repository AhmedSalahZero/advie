<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePageRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name.*'          => 'required|max:255',
            'content.*'       => 'max:10000',

            'sort'          => 'required|max:255',
            'image'         => 'sometimes|required|mimes:jpg,jpeg,bmp,png',
            'banner'        => 'required|mimes:jpg,jpeg,bmp,png',
            'page_id'       =>'required|numeric',
        ];
    }
}
