<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class VacancyResource extends JsonResource
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
            'company' => [
                'id' => $this->company->id, 'name' => $this->company->name,
                'image' => optional(Storage::url($this->company->image), function ($url) {
                    return $this->company->image ? URL::asset($url) : null;
                }),
            ],
            'isOwner' => Auth::check() && $this->company->user_id === Auth::user()->id,
            'salary' => $this->salary,
            'max_salary' => $this->max_salary,
            'experience_months' => $this->experience_months,
            'area' => $this->area->name ?? null,
            'nature' => $this->nature->name,
            'type' => $this->type->name,
            'skills' => $this->skills->pluck('name')->toArray(),
        ];
    }
}
