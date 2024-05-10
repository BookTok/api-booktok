<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id_user' => 'required|integer|exists:users,id',
            'id_book' => 'required|integer|exists:book,id',
            'review' => 'required|string|max:100',
            'rating' => 'required|integer|between:1,5'
        ];
    }

    public function messages()
    {
        return [
            'review.required' => 'The review is required.',
            'review.string' => 'The review must be a string.',
            'review.max' => 'The review cannot exceed 100 characters.',

            'rating.required' => 'The rating is required.',
            'rating.integer' => 'The rating must be a integer.',
            'rating.between' => 'El rating debe estar entre 1 y 5.',
        ];
    }
}
