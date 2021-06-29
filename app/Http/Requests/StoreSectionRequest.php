<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSectionRequest extends FormRequest
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

            'title*.en'=>'required',
            'title*.ar'=>'required',
            'description.en'=>'required',
            'description.ar'=>'required',
            'link'=>'required',
            'image'=>'required|mimes:jpg,jpeg,bmp,png',
        ];
    }
    public function messages()
    {
        return [

            'title*.en.required'=>'you have to Insert The English Title ' ,
            'title*.ar.required'=>'you have to Insert The Arabic Title ' ,
            'name*.en.required'=>'you have to Insert The English Section Name ' ,
            'name*.ar.required'=>'you have to Insert The Arabic Section Name ' ,
            'description*.en.required'=>'you have to Insert The English Description ' ,
            'description*.ar.required'=>'you have to Insert The Arabic Description ' ,
            'link.required'=>'You have to insert The link ',
            'image.required'=>'You have to insert an image ',
            'image.mimes'=>'This type is not supported',
        ];
    }
}
