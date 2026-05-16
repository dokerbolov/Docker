<?php

namespace App\Events;

use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Queue\SerializesModels;

class QuestionnaireStartedEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public int $roomId,
        public string $message
    ) {}

    public function broadcastOn(): array
    {
        return [
            new PresenceChannel("questionnaire.{$this->roomId}")
        ];
    }

    public function broadcastAs(): string
    {
        return 'questionnaire.started';
    }

    public function broadcastWith(): array
    {
        return [
            'message' => $this->message,
            'roomId' => $this->roomId,
        ];
    }
}
