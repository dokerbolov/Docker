<?php

namespace App\Http\Services;

use App\Http\Repositories\QuestionsRepository;

class QuestionsService
{
    protected QuestionsRepository $questionsRepository;

    public function __construct(QuestionsRepository $questionsRepository) {
        $this->questionsRepository = $questionsRepository;
    }

    public function get() {
        return $this->questionsRepository->get();
    }

    public function getById(int $id) {
        return $this->questionsRepository->getById($id);
    }

    public function create(string $name, int $topic_id) {
        return $this->questionsRepository->create($name, $topic_id);
    }

    public function update(int $id, string $name = null, int $topic_id = null) {
        return $this->questionsRepository->update(id: $id,
                                                  name: $name,
                                                  topic_id: $topic_id);
    }

    public function delete(int $id) {
        return $this->questionsRepository->delete($id);
    }
}
