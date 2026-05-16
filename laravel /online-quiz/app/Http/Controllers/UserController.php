<?php

namespace App\Http\Controllers;

use App\Http\Services\UserService;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function get() {
        return $this->userService->get();
    }

    public function getById($user_id) {
        return $this->userService->getById($user_id);
    }
}
