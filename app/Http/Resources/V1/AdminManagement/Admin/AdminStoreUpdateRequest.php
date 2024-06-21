<?php

namespace App\Http\Resources\V1\AdminManagement\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Validation\Rule;

class AdminStoreUpdateRequest extends JsonResource
{
    public function authorize(): bool
    {
        if (($this->getMethod() == 'POST' && $this->user('sanctum')->hasRole('admin'))
            || ($this->getMethod() == 'PUT' && ($this->user('sanctum')->hasRole('admin') || $this->user->id == $this->user('sanctum')->id))) {
            return true;
        }
        return false;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'phone' => ['required', Rule::unique('users', 'phone')],
            'role' => [Rule::requiredIf(function() {
                return $this->getMethod() == 'POST';
            }), Rule::exists('roles', 'name'), Rule::in(['admin', 'manager', 'accountant'])]
        ];
    }
}
