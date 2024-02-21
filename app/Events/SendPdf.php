<?php

namespace App\Events;


use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendPdf implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId;
    public $pdf;
    /**
     * Create a new event instance.
     */
    public function __construct($pdf, $userId)
    {
        $this->userId = $userId;
        $this->pdf = $pdf;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return  new PrivateChannel('users_' . $this->userId);
    }

    public function broadcastAs()
    {
        return 'send-pdf';
    }
}
