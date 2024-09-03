<?php

namespace App\Http\Resources\Frontend;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageListResource extends JsonResource
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
            'package_code' => $this->package_code,
            'package_name' => $this->package_name,
            'country' => $this->country,
            'package_duration' => $this->package_duration,
            'package_person' => $this->package_person,
            'package_rating' => $this->package_rating,
            'package_price' => $this->package_price,
            'package_banner' => $this->package_banner,
        ];
    }
}
