<?php

namespace App\Http\Services;

use App\Http\Repositories\PivotQuestionsAndQuestionnaireRepository;

class PivotQuestionsAndQuestionnaireService
{
    protected PivotQuestionsAndQuestionnaireRepository $pivotQuestionsAndQuestionnaireRepository;

    public function __construct(PivotQuestionsAndQuestionnaireRepository $pivotQuestionsAndQuestionnaireRepository) {
        $this->pivotQuestionsAndQuestionnaireRepository = $pivotQuestionsAndQuestionnaireRepository;
    }

    public function create(int $question_id, int $questionnaire_id) {
        return $this->pivotQuestionsAndQuestionnaireRepository->create($question_id, $questionnaire_id);
    }

    public function delete(int $id) {
        return $this->pivotQuestionsAndQuestionnaireRepository->delete($id);
    }
}
