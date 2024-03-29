<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $message;
    public int $roomId;
    public int $senderId;
    public int $messageId;

    /**
     * Create a new event instance.
     */
    public function __construct($roomId, $senderId, $message, $messageId)
    {
        $this->roomId = $roomId;
        $this->senderId = $senderId;
        $this->message = $message;
        $this->messageId = $messageId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): Channel
    {
        return new PrivateChannel('chat.' . $this->roomId);
    }

    public function broadcastAs(): string {
        return 'chat.message';
    }
}
