<?php

namespace App\Http\Services;

use App\Http\Repositories\UsersRepository;

class UserService
{
    protected UsersRepository $usersRepository;

    public function __construct(UsersRepository $usersRepository) {
        $this->usersRepository = $usersRepository;
    }

    public function get() {
        return $this->usersRepository->get();
    }

    public function getById(int $id) {
        return $this->usersRepository->getById($id);
    }
}
