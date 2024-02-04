<?php

namespace App\Events;

use App\Models\Message;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $sender;
    public $receiver_id;
    public $created_at;

    /**
     * Create a new event instance.
     */
    public function __construct(Message $message)
    {
        $this->receiver_id = $message->receiver_id;
        $this->message = $message->message;
        $this->sender = $message->sender->name;
        $this->created_at = $message->created_at->format('d.m.Y');
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return new Channel('chat.' . $this->receiver_id);
    }

    public function broadcastAs(): string
    {
        return 'new-message';
    }
}
