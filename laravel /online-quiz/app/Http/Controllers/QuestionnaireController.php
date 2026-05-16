<?php

namespace App\Http\Controllers;

use App\Http\Services\QuestionnaireService;
use App\Http\Services\QuestionsService;
use Illuminate\Http\Request;

class QuestionnaireController extends Controller
{
    protected QuestionnaireService $questionnaireService;
    protected QuestionsService $questionsService;

    public function __construct(QuestionnaireService $questionnaireService, QuestionsService $questionsService)
    {
        $this->questionnaireService = $questionnaireService;
        $this->questionsService = $questionsService;
    }

    public function get()
    {
        return response()->json($this->questionnaireService->get());
    }

    public function getById($id)
    {

        return response()->json($this->questionnaireService->getById($id));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'rating' => ['required', 'numeric', 'min:0.1', 'max:5.0'],
            'is_active' => ['required', 'boolean'],
        ]);


        return response()->json($this->questionnaireService->create(
            $request->input('name'),
            $request->input('rating'),
            $request->input('is_active')));
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => ['required', 'integer'],
            'name' => ['string'],
            'rating' => ['numeric', 'min:0.1', 'max:5.0'],
            'is_active' => ['boolean'],
        ]);

        return response()->json($this->questionnaireService->update(
            $request->input('id'),
            $request->input('name'),
            $request->input('rating'),
            $request->input('is_active')));
    }

    public function addQuestions(Request $request) {
        $request->validate([
            'questionnaire_id' => ['required', 'integer'],
            'questions' => ['required', 'array'],
        ]);

        return $this->questionnaireService->addQuestions(questionnaire_id: $request->input('questionnaire_id'),
                                                         questions: $request->input('questions'));
    }

    public function deleteQuestions(Request $request) {
        $request->validate([
            'questionnaire_id' => ['required', 'integer'],
            'questions' => ['required', 'array'],
        ]);

        return $this->questionnaireService->deleteQuestions(questionnaire_id: $request->input('questionnaire_id'),
                                                            questions: $request->input('questions'));
    }

    public function rate(Request $request) {
        $request->validate([
            'questionnaire_id' => ['required', 'integer'],
            'rating' => ['required', 'integer'],
        ]);

        return $this->questionnaireService->rate(questionnaire_id: $request->input('questionnaire_id'),
                                                 rating: $request->input('rating'));
    }

    public function delete($id)
    {
        return response()->json($this->questionnaireService->delete($id));
    }
}
