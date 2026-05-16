<?php

namespace App\Http\Controllers;

use App\Http\Services\QuestionsAnswersService;
use App\Http\Services\QuestionsService;
use Illuminate\Http\Request;

class QuestionsAnswersController extends Controller
{
    protected QuestionsService $questionsService;
    protected QuestionsAnswersService $questionsAnswersService;

    public function __construct(QuestionsService $questionsService,
                                QuestionsAnswersService $questionsAnswersService) {
        $this->questionsService = $questionsService;
        $this->questionsAnswersService = $questionsAnswersService;
    }

    public function get() {
        return response()->json($this->questionsAnswersService->get());
    }

    public function getById($id) {

        return response()->json($this->questionsAnswersService->getById($id));
    }

    public function create(Request $request) {
        $request->validate([
            'name' => ['required', 'string'],
            'question_id' => ['required', 'integer'],
            'right_answer' => ['required', 'boolean'],
        ]);

        $topic = $this->questionsService->getById($request->input('question_id'));

        if(isset($topic)) {
            return response()->json($this->questionsAnswersService->create(
                $request->input('name'),
                $request->input('question_id'),
                $request->input('right_answer')));
        } else {
            return response()->json('Question not found', 400);
        }
    }

    public function update(Request $request) {
        $request->validate([
            'id' => ['required', 'int'],
            'name' => ['string'],
            'question_id' => ['integer'],
            'right_answer' => ['boolean'],
        ]);

        return response()->json($this->questionsAnswersService->update(
            $request->input('id'),
            $request->input('name'),
            $request->input('question_id'),
            $request->input('right_answer')));
    }

    public function delete($id) {
        return response()->json($this->questionsAnswersService->delete($id));
    }
}
