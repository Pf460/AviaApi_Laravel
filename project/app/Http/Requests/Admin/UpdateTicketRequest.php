<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTicketRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes' ,'required', 'string', 'max:255'],
            'description' => ['sometimes' ,'required', 'string', 'max:2000'],
            'price' => ['sometimes' ,'required', 'decimal:0,2', 'min:0'],
        ];
    }
}
