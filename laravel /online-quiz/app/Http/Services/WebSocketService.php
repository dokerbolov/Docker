<?php

namespace App\Http\Services;

use App\Events\QuestionnaireStartedEvent;
use App\Events\QuestionnaireUserEndedEvent;
use App\Http\Repositories\BroadcastChannelsRepository;
use Carbon\Carbon;

class WebSocketService
{
    public BroadcastChannelsRepository $broadcastChannelsRepository;

    public function __construct(BroadcastChannelsRepository $broadcastChannelsRepository)
    {
        $this->broadcastChannelsRepository = $broadcastChannelsRepository;
    }

    public function createRoom(int $questionnaire_id, int $user_id){
        $room_id = Carbon::now()->timestamp . $questionnaire_id;

        $result = $this->broadcastChannelsRepository->create(
                                            room_id: $room_id,
                                            owner_id: $user_id,
                                            questionnaire_id: $questionnaire_id);

        return $result->id;
    }

    public function startSurvey(int $room_id) {
        event(new QuestionnaireStartedEvent($room_id, 'start'));
        return 1;
    }

    public function userEndedSurvey(int $room_id, int $user_id) {
        event(new QuestionnaireUserEndedEvent($room_id, $user_id));
        return 1;
    }

    public function getRoom(int $room_id) {
        return $this->broadcastChannelsRepository->get(room_id: $room_id);
    }
}
