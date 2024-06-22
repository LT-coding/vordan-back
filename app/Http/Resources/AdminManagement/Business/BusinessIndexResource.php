<?php

namespace App\Http\Resources\AdminManagement\Business;

use App\Http\Resources\AdminManagement\BusinessAdmin\BusinessAdminIndexResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BusinessIndexResource extends JsonResource
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
            'company_name' => $this->company_name,
            'verified' => (bool) $this->verified,
            'logo' => $this->logo(),
            'admin' => new BusinessAdminIndexResource($this->businessAdmins()->first()),
            'created_at' => $this->created_at->format('d/m/Y'),
        ];
    }
}
