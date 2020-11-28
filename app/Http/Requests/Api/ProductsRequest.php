<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
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
        return 
        [
            'name'          => 'required|unique:products,name,'.$this->id,
            'price'         => 'required',
            'quantity'      => 'required',
            'description'   => 'required',
        ];
    }


    // public function messages()
    // {
    //     return 
    //     [
    //         'name.required'     => '',
            
    // ];
}