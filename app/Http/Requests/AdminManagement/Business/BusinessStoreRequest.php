<?php

namespace App\Http\Requests\AdminManagement\Business;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BusinessStoreRequest extends FormRequest
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
            'company_name' => ['required', 'max:255'],
            'logo' => ['nullable', Rule::imageFile()],
            'tax_code' => ['required', 'integer', Rule::unique('business_accounts', 'tax_code')],
            'register_code' => ['required', 'max:255', Rule::unique('business_accounts', 'register_code')],
            'registered_address' => ['required', 'max:255'],
            'activity_address' => ['nullable'],
            'name' => ['required'],
            'email' => ['required', Rule::unique('users', 'email')],
            'phone' => ['required', Rule::unique('users', 'phone')]
        ];
    }
}
