<?php
namespace App\Http\Requests\Reviews;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'comment' => 'sometimes|string|max:500',
            'rating' => 'sometimes|integer|between:1,5',
        ];
    }
}
