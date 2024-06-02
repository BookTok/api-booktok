<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'author' => 'required|exists:authors,id',
            'publisher' => 'required|exists:publishers,id',
            'description' => 'required|string|max:200',
            'sales'=> 'required|string',
            'publication'=> 'required|date',
            'genre'=> 'required|string',
            'pages'=> 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name cannot exceed 100 characters.',

            'author.required' => 'The author is required.',
            'author.string' => 'The author must be a string.',
            'author.max' => 'The author cannot exceed 50 characters.',

            'publisher.required' => 'The publisher is required.',
            'publisher.string' => 'The publisher must be a string.',
            'publisher.max' => 'The publisher cannot exceed 50 characters.',

            'description.required' => 'The description is required.',
            'description.string' => 'The description must be a string.',
            'description.max' => 'The description cannot exceed 200 characters.',

            'sales.required' => 'The sales is required.',
            'sales.string' => 'The sales must be a string.',

            'publication.required' => 'The publication is required.',
            'publication.string' => 'The publication must be a date.',

            'genre.required' => 'The genre is required.',
            'genre.string' => 'The genre must be a string.',
        ];
    }
}
