<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:categories|max:255|min:3',
            'slug' => 'required|max:255|min:3',
            'description' => 'required|min:3',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ];
    }
}
