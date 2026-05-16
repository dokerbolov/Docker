<?php

namespace App\Http\Controllers;

use App\Http\Services\QuestionsService;
use App\Http\Services\TopicServices;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    protected QuestionsService $questionsService;
    protected TopicServices $topicServices;

    public function __construct(QuestionsService $questionsService,
                                TopicServices $topicServices) {
        $this->questionsService = $questionsService;
        $this->topicServices = $topicServices;
    }

    public function get() {
        return response()->json($this->questionsService->get());
    }

    public function getById($id) {

        return response()->json($this->questionsService->getById($id));
    }

    public function create(Request $request) {
        $request->validate([
            'name' => ['required', 'string'],
            'topic_id' => ['required', 'integer']
        ]);

        $topic = $this->topicServices->getById($request->input('topic_id'));

        if(isset($topic)) {
            return response()->json($this->questionsService->create($request->input('name'),
                $request->input('topic_id')));
        } else {
            return response()->json('Topic not found', 400);
        }
    }

    public function update(Request $request) {
        $request->validate([
            'id' => ['required', 'int'],
            'name' => ['string'],
            'topic_id' => ['integer'],
        ]);

        return response()->json($this->questionsService->update($request->input('id'),
                                                                $request->input('name'),
                                                                $request->input('topic_id')));
    }

    public function delete($id) {
        return response()->json($this->questionsService->delete($id));
    }
}
