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
                'id' =>   $this->company->id ?? $this->user->id,
                'name' =>  $this->company->name ?? $this->user->name,
                'image' => $this->company_id ?
                    optional(Storage::url($this->company->image), function ($url) {
                        return $this->company->image ? URL::asset($url) : null;
                    })
                    :
                    optional(Storage::url($this->user->image), function ($url) {
                        return $this->user->image ? URL::asset($url) : null;
                    }),
            ],
            'children' =>  $this->replies ? $this->replies->map(function ($review) {
                return [
                    'id' => $review->id,
                    'review' => $review->review,
                    'isOwner' => $review->user_id === Auth::user()->id,
                    'company_id' => $review->company_id,
                    'created_at' => $review->created_at->format('d.m.Y'),
                    'updated_at' => $review->updated_at->format('d.m.Y'),
                    'owner' => [
                        'id' =>  $review->company_id ?? $review->user_id,
                        'name' =>  $review->company->name ?? $review->user->name,
                        'image' => $review->company_id ?
                            optional(Storage::url($review->company->image))->value(function ($url) {
                                return $this->company->image ? URL::asset($url) : null;
                            })

                            :  optional(Storage::url($review->user->image))->value(function ($url) {
                                return $this->user->image ? URL::asset($url) : null;
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
