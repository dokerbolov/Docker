<?php

namespace App\Events;

use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Queue\SerializesModels;

class QuestionnaireUserEndedEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public int $roomId,
        public string $userId
    ) {}

    public function broadcastOn(): array
    {
        return [
            new PresenceChannel("questionnaire.{$this->roomId}")
        ];
    }

    public function broadcastAs(): string
    {
        return 'questionnaire.finished';
    }

    public function broadcastWith(): array
    {
        return [
            'userId' => $this->userId,
            'roomId' => $this->roomId,
        ];
    }
}
