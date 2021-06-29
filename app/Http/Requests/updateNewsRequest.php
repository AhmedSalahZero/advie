<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateNewsRequest extends FormRequest
{

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
                        'banner'        => 'sometimes|mimes:jpg,jpeg,bmp,png',
            'image'        => 'sometimes|mimes:jpg,jpeg,bmp,png',
        ];
    }



}
