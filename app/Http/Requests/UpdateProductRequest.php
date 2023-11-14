<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest {
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
            'title' => 'sometimes|required',
            'size' => 'sometimes|required',
            'color' => 'sometimes|required',
            'brand_id' => 'sometimes|required',
            'category_id' => 'sometimes|required',
            'arrival_time' => 'sometimes|required|date',
        ];
    }
}
