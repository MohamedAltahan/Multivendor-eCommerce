<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

//------------use implements ShouldBroadcast
class MessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message, $receiver_id, $dateTime;
    /**
     * Create a new event instance.
     */
    public function __construct($message, $receiver_id, $dateTime)
    {
        $this->message = $message;
        $this->receiver_id = $receiver_id;
        $this->dateTime = $dateTime;
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            //write the channel name
            new PrivateChannel('message.' . $this->receiver_id),
        ];
    }

    //send this data with broadcast to pusher
    public function broadcastWith(): array
    {
        return [
            'message' => $this->message,
            'receiver_id' => $this->receiver_id,
            'sender_id' => auth()->user()->id,
            'sender_image' => asset('uploads/' . auth()->user()->image),
            'date_time' => $this->dateTime,
        ];
    }
}
