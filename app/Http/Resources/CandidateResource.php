<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class CandidateResource extends JsonResource
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
            'profession' => $this->profession->name,
            'user' => [
                'id' => $this->user->id,
                'phone' => $this->user->telephone ?? null,
                'email' => $this->user->email,
                'name' => $this->user->name,
                'image' => optional(Storage::url($this->user->image), function ($url) {
                    return $this->user->image ? URL::asset($url) : null;
                }),
            ],
            'isOwner' => $this->user->id === Auth::user()->id,
            'salary' => $this->salary,
            'max_salary' => $this->max_salary,
            'area' => $this->area->name ?? null,
            'nature' => $this->nature->name,
            'types' => $this->types->pluck('name')->toArray(),
            'skills' => $this->skills->pluck('name')->toArray(),
        ];
    }
}
