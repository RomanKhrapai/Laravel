<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

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
            'conpany' => $this->company->name,
            'salary' => $this->salary,
            'max_salary' => $this->max_salary,
            'area' => $this->area->name ?? null,
            'nature' => $this->nature->name,
            'type' => $this->type->name,
            'skills' => $this->skills->pluck('name')->toArray(),
        ];
    }
}
