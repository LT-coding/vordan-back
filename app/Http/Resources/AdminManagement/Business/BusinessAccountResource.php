<?php

namespace App\Http\Resources\AdminManagement\Business;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BusinessAccountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'tax_code' => $this->tax_code,
            'register_code' => $this->register_code,
            'registered_address' => $this->registered_address,
            'activity_address' => $this->activity_address,
        ];
    }
}
