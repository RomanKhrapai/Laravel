<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
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
            'sender_id' => $this->sender_id,
            'sender' => $this->sender->name,
            'company_id' => $this->company_id,
            'company' => $this->company->name,
            'receiver_id' => $this->receiver_id,
            'receiver' => $this->receiver->name,
            'message' => $this->message,
            'created_date' => $this->created_at->format('d.m.Y'),
            'created_time' => $this->created_at->format('H:i'),
        ];
    }
}
