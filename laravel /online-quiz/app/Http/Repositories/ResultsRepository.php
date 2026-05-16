<?php

namespace App\Http\Repositories;

use App\Models\Results;
use React\Stream\ReadableResourceStream;

class ResultsRepository
{
    public function get() {
        return Results::all();
    }

    public function getById($id) {
        return Results::findOrFail($id);
    }

    public function getByUserId($user_id) {
        return Results::with(['questionnaire.questions.answers'])
            ->where('user_id', '=', $user_id)
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function getByRoomId($room_id) {
        return Results::with(['questionnaire.questions.answers'])
            ->where('room_id', '=', $room_id)
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function getByQuestionnaireId($questionnaire_id) {
        return Results::with(['questionnaire', 'user'])
            ->where('questionnaire_id', '=', $questionnaire_id)
            ->get();
    }

    public function create($user_id, $questionnaire_id, $score, $room_id = null) {
        Results::create([
            'user_id' => $user_id,
            'questionnaire_id' => $questionnaire_id,
            'score' => $score,
            'room_id' => $room_id
        ]);

        return 1;
    }

    public function update($id, $user_id = null, $questionnaire_id = null, $score = null) {
        $result = Results::where($id, '=', 'id')->first();
        $result->user_id = isset($user_id) ? $result->user_id : $user_id;
        $result->questionnaire_id = isset($user_id) ? $result->questionnaire_id : $questionnaire_id;
        $result->score = isset($score) ? $result->score : $score;
        $result->save();

        return 1;
    }

    public function delete($id) {
        Results::destroy($id);

        return 1;
    }
}
