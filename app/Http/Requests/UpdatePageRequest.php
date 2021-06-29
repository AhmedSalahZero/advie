<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name.*'            => 'required|max:255',
            'content.*'         => 'max:10000',
            'page_id'           => 'required|max:255',
            'sort'              => 'required|max:255',
            'image'             => 'sometimes|required|mimes:jpg,jpeg,bmp,png',
            'banner'            => 'mimes:jpg,jpeg,bmp,png',
        ];
    }
}
