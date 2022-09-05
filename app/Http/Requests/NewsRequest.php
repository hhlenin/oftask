<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
            'image' => 'image'
        ];
    }
    public function messages()
    {
        return [
            'body.required' => 'The Description is required',
            'category_id' => 'The Category is required',
            'image.image' => 'The file must be a valid image',

        ];
    }
}
