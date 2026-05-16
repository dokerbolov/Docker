<?php

namespace App\Http\Controllers;

use App\Http\Services\ResultService;
use App\Http\Services\WebSocketService;
use Illuminate\Http\Request;

class ResultsController extends Controller
{
    protected ResultService $resultService;
    protected WebSocketService $webSocketService;

    public function __construct(ResultService $resultService, WebSocketService $webSocketService) {
        $this->resultService = $resultService;
        $this->webSocketService = $webSocketService;
    }

    public function get() {
        return response()->json($this->resultService->get());
    }

    public function getById($id) {
        return response()->json($this->resultService->getById($id));
    }

    public function getByUserId($user_id) {
        return response()->json($this->resultService->getByUserId($user_id));
    }

    public function getByRoomId($room_id) {
        return response()->json($this->resultService->getByRoomId($room_id));
    }

    public function getByQuestionnaireId($questionnaire_id) {
        return response()->json($this->resultService->getByQuestionnaireId($questionnaire_id));
    }

    public function create(Request $request) {
        $request->validate([
            'user_id' => ['required', 'integer'],
            'questionnaire_id' => ['required', 'integer'],
            'score' => ['required', 'numeric'],
        ]);

        return response()->json($this->resultService->create(
                                        user_id: $request->input('user_id'),
                                        questionnaire_id: $request->input('questionnaire_id'),
                                        score: $request->input('score')));
    }

    public function update(Request $request) {
        $request->validate([
            'id' => ['required', 'int'],
            'user_id' => ['integer'],
            'questionnaire_id' => ['integer'],
            'score' => ['numeric'],
        ]);

        return response()->json($this->resultService->update(
                            id: $request->input('id'),
                            user_id: $request->input('user_id'),
                            questionnaire_id: $request->input('questionnaire_id'),
                            score: $request->input('score')));
    }

    public function delete($id) {
        return response()->json($this->resultService->delete($id));
    }

    public function submitQuestionnaire(Request $request) {
        $score = $this->resultService->calculateScore($request->input('questionnaire_id'),
                                                    $request->input('answers'));

        $result = $this->resultService->create( $request->input('user_id'),
                                                $request->input('questionnaire_id'),
                                                $score,
                                                $request->input('room_id'));

        return response()->json($result);
    }

    public function submitQuestionnaireRoom(Request $request) {
        $result = $this->submitQuestionnaire($request);

        $this->webSocketService->userEndedSurvey($request->input('room_id'), $request->input('user_id'));

        return $result;
    }
}
