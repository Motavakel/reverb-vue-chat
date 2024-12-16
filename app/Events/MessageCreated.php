<?php

namespace App\Events;

use App\Http\Resources\MessageResource;
use App\Models\Message;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageCreated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public function __construct(protected Message $message)
    {
        //
    }

    public function broadcastWith(){
        return MessageResource::make($this->message)->toArray(request());
    }

    public function broadcastOn(): array
    {
        return [
            new PresenceChannel('room.'.$this->message->room_id),
        ];
    }
}
