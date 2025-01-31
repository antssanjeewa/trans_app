<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransportResource extends JsonResource
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
            'date' => $this->date ?? now()->format('Y-m-d'),
            'from' => $this->from ?? 'N/A',
            'to' => $this->to ?? 'N/A',
            'description' => $this->description ?? 'No Description',
            'distance' => $this->distance ?? 0,
            'user_id' => $this->user_id,
            'user_name' => $this->user ? $this->user->name : 'Unknown User',
            'driver_id' => $this->driver_id,
            'driver_name' => $this->driver ? $this->driver->name : 'Unknown Driver',
            'vehicle_id' => $this->vehicle_id,
        ];
    }
}
