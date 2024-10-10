<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
        $productId = $this->route('product');
        $productId = $productId->id;
        return [
            'name' => 'nullable|string|unique:products,name,' . $productId . '|max:255',
            'title' => 'nullable|string|unique:products,title,' . $productId . '|max:255',
            'image' => 'nullable|url',
            'price' => 'nullable|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'نام محصول باید یکتا باشد.',
            'title.unique' => 'عنوان محصول باید یکتا باشد.',
            'price.numeric' => 'قیمت باید عدد باشد.',
            'price.min' => 'قیمت باید مثبت باشد.',
        ];
    }
}
