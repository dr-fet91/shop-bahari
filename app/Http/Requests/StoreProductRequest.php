<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|unique:products,name|max:255',
            'title' => 'required|string|unique:products,title|max:255',
            'image' => 'nullable|url',
            'price' => 'required|numeric|min:0', 
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'نام محصول الزامی است.',
            'name.unique' => 'نام محصول باید یکتا باشد.',
            'title.required' => 'عنوان محصول الزامی است.',
            'title.unique' => 'عنوان محصول باید یکتا باشد.',
            'price.required' => 'قیمت محصول الزامی است.',
            'price.numeric' => 'قیمت باید عدد باشد.',
            'price.min' => 'قیمت باید مثبت باشد.',
        ];
    }
}
