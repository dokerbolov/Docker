<?php

namespace App\Http\Services;

use App\Http\Repositories\QuestionsAnswersRepository;
use App\Http\Repositories\QuestionsRepository;

class QuestionsAnswersService
{
    protected QuestionsAnswersRepository $questionsAnswersRepository;

    public function __construct(QuestionsAnswersRepository $questionsAnswersRepository) {
        $this->questionsAnswersRepository = $questionsAnswersRepository;
    }

    public function get() {
        return $this->questionsAnswersRepository->get();
    }

    public function getById(int $id) {
        return $this->questionsAnswersRepository->getById($id);
    }

    public function create(string $name, int $question_id, bool $right_answer) {
        return $this->questionsAnswersRepository->create($name, $question_id, $right_answer);
    }

    public function update(int $id, string $name = null, int $question_id = null, bool $right_answer = null) {
        return $this->questionsAnswersRepository->update(id: $id,
                                                         name: $name,
                                                         question_id: $question_id,
                                                         right_answer: $right_answer);
    }

    public function delete(int $id) {
        return $this->questionsAnswersRepository->delete($id);
    }
}
