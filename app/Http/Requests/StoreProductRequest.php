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
            'add_type' => 'required|in:sele,buy',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'نام محصول الزامی است.',
            'name.unique' => 'نام محصول باید یکتا باشد.',
            'name.max' => 'نام محصول نمی‌تواند بیش از ۲۵۵ کاراکتر باشد.',
            'title.required' => 'عنوان محصول الزامی است.',
            'title.unique' => 'عنوان محصول باید یکتا باشد.',
            'title.max' => 'عنوان محصول نمی‌تواند بیش از ۲۵۵ کاراکتر باشد.',
            'image.url' => 'لینک تصویر معتبر نمی‌باشد.',
            'price.required' => 'قیمت محصول الزامی است.',
            'price.numeric' => 'قیمت باید عدد باشد.',
            'price.min' => 'قیمت باید مثبت باشد.',
            'add_type.required' => 'نوع معامله الزامی است.',
            'add_type.in' => 'نوع معامله باید یکی از مقادیر "sele" یا "buy" باشد.',
        ];
    }
}
