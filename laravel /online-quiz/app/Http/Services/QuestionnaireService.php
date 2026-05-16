<?php

namespace App\Http\Services;

use App\Http\Repositories\PivotQuestionsAndQuestionnaireRepository;
use App\Http\Repositories\QuestionnaireRepository;
use App\Http\Repositories\ResultsRepository;

class QuestionnaireService
{
    protected QuestionnaireRepository $questionnaireRepository;
    protected PivotQuestionsAndQuestionnaireRepository $pivotQuestionsAndQuestionnaireRepository;
    protected ResultsRepository $resultsRepository;

    public function __construct(QuestionnaireRepository $questionnaireRepository,
                                PivotQuestionsAndQuestionnaireRepository $pivotQuestionsAndQuestionnaireRepository,
                                ResultsRepository $resultsRepository) {
        $this->questionnaireRepository = $questionnaireRepository;
        $this->pivotQuestionsAndQuestionnaireRepository = $pivotQuestionsAndQuestionnaireRepository;
        $this->resultsRepository = $resultsRepository;
    }

    public function get() {
        return $this->questionnaireRepository->get();
    }

    public function getById(int $id) {
        return $this->questionnaireRepository->getById($id);
    }

    public function create(string $name, float $rating, bool $is_active) {
        return $this->questionnaireRepository->create($name, $rating, $is_active);
    }

    public function update(int $id, string $name = null, float $rating = null, bool $is_active = null) {
        return $this->questionnaireRepository->update(id: $id,
                                                     name: $name,
                                                     rating: $rating,
                                                     is_active: $is_active);
    }

    public function addQuestions(int $questionnaire_id, array $questions) {
        foreach ($questions as $question) {
            $this->pivotQuestionsAndQuestionnaireRepository->create($question['id'], $questionnaire_id);
        }

        return 1;
    }

    public function deleteQuestions(int $questionnaire_id, array $questions) {
        foreach ($questions as $question) {
            $this->pivotQuestionsAndQuestionnaireRepository->remove($question['id'], $questionnaire_id);
        }

        return 1;
    }

    public function rate(int $questionnaire_id, int $rating) {
        $questionnairesResults = $this->resultsRepository->getByQuestionnaireId($questionnaire_id);

        $new_rating = ($rating + $questionnairesResults[0]->questionnaire->rating)/2;

        return $this->questionnaireRepository->rate($questionnaire_id, $new_rating);
    }

    public function delete(int $id) {
        return $this->questionnaireRepository->delete($id);
    }
}
