<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'name' => ['required', 'max:255'],
            'description' => ['required', 'max:1000'],
            'category_id' => ['required', 'exists:categories,id'],
            'price' => ['required', 'min:0', 'integer'],
            'image' => [
               'required', 
               'file',
               'image',
               'mimes:jpeg,jpg,png',
               'dimensions:min-width=50,min-width=50,max-width=1000,max-height=1000',
                ],
        ];
    }
}
