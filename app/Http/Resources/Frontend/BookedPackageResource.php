<?php

namespace App\Http\Resources\Frontend;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookedPackageResource extends JsonResource
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
            'package' => new PackageListResource($this->whenLoaded('package')),
            'traveller_email' => $this->traveller_email,
            'traveller_phone' => $this->traveller_phone,
            'number_of_adult' => $this->number_of_adult,
            'number_of_child' => $this->number_of_child,
            'adult_infos' => json_decode($this->adult_infos),
            'child_infos' => json_decode($this->child_infos),
            'coupon' => $this->coupon,
            'journey_date' => $this->journey_date,
            'other_requirements' => $this->other_requirements,
            'medical_consultation' => $this->medical_consultation,
            'booking_status' => $this->booking_status,
            'total_amount' => $this->total_amount,
            'discount_amount' => $this->discount_amount,
            'advanced_amount' => $this->advanced_amount,
            'paid_amount' => $this->paid_amount,
            'due_amount' => $this->due_amount,
            'due_payment_date' => $this->due_payment_date,
            'payment_status' => $this->payment_status,
        ];
    }
}
