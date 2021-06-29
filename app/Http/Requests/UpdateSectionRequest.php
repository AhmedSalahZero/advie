<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSectionRequest extends FormRequest
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
            'name.en'=>'required',
            'name.ar'=>'required',
            'title*.en'=>'required',
            'title*.ar'=>'required',
            'description.en'=>'required',
            'description.ar'=>'required',
            'link'=>'required',
            'image'=>'mimes:jpg,jpeg,bmp,png',

        ];
    }
    public function messages()
    {
        return [
            'title*.en.required'=>'you have to Insert The English Title ' ,
            'title*.ar.required'=>'you have to Insert The Arabic Title ' ,
            'description*.en.required'=>'you have to Insert The English Description ' ,
            'description*.ar.required'=>'you have to Insert The Arabic Description ' ,
            'link.required'=>'You have to insert The link ',
            'image.mimes'=>'This type does not supported',
            'name*.en.required'=>'you have to Insert The English Section Name ' ,
            'name*.ar.required'=>'you have to Insert The Arabic Section Name ' ,

        ];
    }
}
