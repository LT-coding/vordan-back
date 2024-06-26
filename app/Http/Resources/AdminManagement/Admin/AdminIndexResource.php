<?php

namespace App\Http\Resources\AdminManagement\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = $this->user ?? $this;
        return [
            'id' => $this->id,
            'phone' => $user->phone,
            'email' => $user->email,
            'name' => $this->name,
            'role' => $user->getRoleNames()
        ];
    }
}
