<?php

namespace App\Http\Resources\Chat;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

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
            'companyId' => $this->company_id,
            'userId' =>  $this->user_id,
            'yoyrName' => $this->user->role_id !== 2 ? $this->user->name : $this->company->name,
            'yoyrImage' => $this->user->role_id !== 2 ?
                optional(Storage::url($this->user->image), function ($url) {
                    return $this->user->image ? URL::asset($url) : null;
                }) :
                optional(Storage::url($this->company->image), function ($url) {
                    return $this->company->image ? URL::asset($url) : null;
                }),
            'interlocutorName' => $this->user->role_id == 2 ? $this->user->name : $this->company->name,
            'interlocutorImage' => $this->user->role_id == 2 ?
                optional(Storage::url($this->user->image), function ($url) {
                    return $this->user->image ? URL::asset($url) : null;
                }) :
                optional(Storage::url($this->company->image), function ($url) {
                    return $this->company->image ? URL::asset($url) : null;
                }),
            "read" => $this->lastMessage && $this->lastMessage->sender_id !== Auth::user()->id ?
                $this->lastMessage->read : null,
            "createdAt" => $this->lastMessage ? $this->lastMessage->created_at : null,
        ];
    }
}
