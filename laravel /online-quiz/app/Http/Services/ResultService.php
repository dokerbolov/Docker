<?php

namespace App\Http\Services;

use App\Http\Repositories\QuestionnaireRepository;
use App\Http\Repositories\ResultsRepository;

class ResultService
{
    protected ResultsRepository $resultsRepository;
    protected QuestionnaireRepository $questionnaireRepository;

    public function __construct(ResultsRepository $resultsRepository,
                                QuestionnaireRepository $questionnaireRepository) {
        $this->resultsRepository = $resultsRepository;
        $this->questionnaireRepository = $questionnaireRepository;
    }

    public function get() {
        return $this->resultsRepository->get();
    }

    public function getById(int $id) {
        return $this->resultsRepository->getById($id);
    }

    public function getByRoomId(int $id) {
        return $this->resultsRepository->getByRoomId($id);
    }

    public function getByUserId(int $user_id) {
        return $this->resultsRepository->getByUserId($user_id);
    }

    public function getByQuestionnaireId(int $questionnaire_id) {
        return $this->resultsRepository->getByQuestionnaireId($questionnaire_id);
    }

    public function create(int $user_id, int $questionnaire_id, float $score, int $room_id = null) {
        return $this->resultsRepository->create(user_id:$user_id,
                                                questionnaire_id: $questionnaire_id,
                                                score: $score,
                                                room_id: $room_id);
    }

    public function update(int $id, int $user_id = null, int $questionnaire_id = null, float $score = null) {
        return $this->resultsRepository->update(id: $id,
                                                user_id: $user_id,
                                                questionnaire_id: $questionnaire_id,
                                                score: $score);
    }

    public function delete(int $id) {
        return $this->resultsRepository->delete($id);
    }

    public function calculateScore(int $questionnaire_id, array $response) {
        $questionnaire = $this->questionnaireRepository->getById($questionnaire_id);

        $right_answers = 0;

        foreach ($response as $user_answers) {
            foreach ($questionnaire->questions as $question) {
                if($question->id === $user_answers['question_id']) {
                    foreach ($question->answers as $answer) {
                        if($answer->id === $user_answers['answer_id']) {
                            if($answer->right_answer === 1) {
                                $right_answers++;
                                break;
                            } else {
                                break;
                            }
                        }
                    }
                }
            }
        }

        return $right_answers;
    }
}
