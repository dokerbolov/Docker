<?php

namespace App\Http\Repositories;

use App\Models\BroadcastChannels;

class BroadcastChannelsRepository
{
    public function get(int $room_id) {
        return BroadcastChannels::where('id', '=', $room_id)->first();
    }

    public function create(int $room_id, int $owner_id, int $questionnaire_id, bool $visibility = false) {
        return BroadcastChannels::create([
            'room_id' => $room_id,
            'owner_id' => $owner_id,
            'questionnaire_id' => $questionnaire_id,
            'visibility' => $visibility
        ]);
    }
}
