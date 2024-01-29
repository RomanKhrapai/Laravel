<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class ReviewResource extends JsonResource
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
            'review' => $this->review,
            'vote' => $this->vote,
            'owner' => [
                'id' => $this->user_id ? $this->user->id : $this->company->id,
                'name' => $this->user_id ? $this->user->name : $this->company->name,
                'image' => $this->user_id ? optional(Storage::url($this->user->image), function ($url) {
                    return $this->user->image ? URL::asset($url) : null;
                }) : optional(Storage::url($this->company->image), function ($url) {
                    return $this->company->image ? URL::asset($url) : null;
                }),
            ],
            'children' =>  $this->reviews ? $this->reviews->map(function ($review) {
                return [
                    'id' => $review->id,
                    'title' => $review->review,
                    'vote' => $this->vote,
                    'owner' => [
                        'id' => $this->user_id ? $this->user_id : $this->company_id,
                        'name' => $this->user_id ? $this->user->name : $this->company->name,
                        'image' => $this->user_id ? optional(Storage::url($this->user->image), function ($url) {
                            return $this->user->image ? URL::asset($url) : null;
                        }) : optional(Storage::url($this->company->image), function ($url) {
                            return $this->company->image ? URL::asset($url) : null;
                        }),
                    ],
                ];
            })->toArray() : [],
            'isOwner' => $this->user_id === Auth::user()->id,
            'company_id' => $this->company_id,
            'created_at' => $this->created_at->format('d.m.Y'),
            'updated_at' => $this->updated_at->format('d.m.Y')
        ];
    }
}
