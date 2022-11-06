<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EpisodeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::guard('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nameofep' => 'required|unique:episodes|max:255|min:3',
            'slug' => 'required|max:255|min:3',
            'link1' => 'required|min:3',
            'link2' => 'required|min:3',
            'link3' => 'required|min:3',
        ];
    }
}
