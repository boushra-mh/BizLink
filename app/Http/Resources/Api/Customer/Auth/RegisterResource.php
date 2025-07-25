<?php

namespace App\Http\Resources\Api\Customer\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RegisterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
      
        return [
            'id'          => $this->id,
            'first_name'  => $this->first_name,
            'last_name'   => $this->last_name,
            'phone'       => $this->phone,
            'state'       => $this->state->name ?? null,
            'city'        => $this->city->name ?? null,
            'is_verified' => $this->is_verified,
            'is_active'   => $this->is_active,
        ];
    }
}
