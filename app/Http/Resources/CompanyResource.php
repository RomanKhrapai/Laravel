<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class CompanyResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'image' => optional(Storage::url($this->image), function ($url) {
                return $this->image ? URL::asset($url) : null;
            }),
            'address' => $this->address,
            'owner' => $this->user->name,
            'isOwner' => Auth::check() && $this->user->id === Auth::user()->id,
            'created_at' => $this->created_at ?? null,
            'updated_at' => $this->updated_at ?? null,
            'vacancies' => $this->vacancies->map(function ($vacancy) {
                return ['id' => $vacancy->id, 'title' => $vacancy->title];
            })->toArray(),
        ];
    }
}
