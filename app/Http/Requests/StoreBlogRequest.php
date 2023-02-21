<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
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
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'title' => 'required|string|min:3',
            'description' => 'nullable|string',
            'content' => 'required|string|min:10',
            'image' => 'nullable|image'
        ];
    }
}
