<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image,
            'author' => $this->author,
            'author_details' => $this->author_details,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_date' => Carbon::parse($this->created_at)->format('d'),
            'created_month' => Carbon::parse($this->created_at)->format('M'),
        ];
    }
}
