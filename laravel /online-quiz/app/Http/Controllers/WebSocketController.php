<?php

namespace App\Http\Controllers;

use App\Http\Services\WebSocketService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WebSocketController extends Controller
{
    protected WebSocketService $webSocketService;

    public function __construct(WebSocketService $webSocketService)
    {
        $this->webSocketService = $webSocketService;
    }

    public function createRoom(Request $request) {
        $request->validate([
            'questionnaire_id' => ['required', 'int'],
            'user_id' => ['required', 'int'],
        ]);

        $result = $this->webSocketService->createRoom($request->input('questionnaire_id'),
                                                      $request->input('user_id'));

        return $result;
    }

    public function startSurvey(Request $request) {
        $request->validate([
            'room_id' => ['required', 'int']
        ]);

        return $this->webSocketService->startSurvey($request->input('room_id'));
    }

    public function userEndedSurvey(Request $request) {
        $request->validate([
            'room_id' => ['required', 'int']
        ]);

        return $this->webSocketService->userEndedSurvey($request->input('room_id'));
    }

    public function getRoomData(Request $request) {
        $request->validate([
            'room_id' => ['required', 'int']
        ]);

        return $this->webSocketService->getRoom($request->input('room_id'));
    }
}
