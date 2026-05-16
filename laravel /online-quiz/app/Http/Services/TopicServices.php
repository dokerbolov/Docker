<?php

namespace App\Http\Services;

use App\Http\Repositories\TopicRepository;

class TopicServices
{
    protected TopicRepository $topicRepository;

    public function __construct(TopicRepository $topicRepository) {
        $this->topicRepository = $topicRepository;
    }

    public function get() {
        return $this->topicRepository->get();
    }

    public function getById(int $id) {
        return $this->topicRepository->getById($id);
    }

    public function create(string $name) {
        return $this->topicRepository->create($name);
    }

    public function update(int $id, string $name) {
        return $this->topicRepository->update($id, $name);
    }

    public function delete(int $id) {
        return $this->topicRepository->delete($id);
    }
}
