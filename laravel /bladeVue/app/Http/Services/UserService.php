<?php

namespace App\Http\Services;

use App\Http\Repositories\UserRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class UserService
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function get(): Collection {
        return $this->userRepository->get();
    }

    public function auth($id) {
        Auth::logout();
        Auth::loginUsingId($id);
        request()->session()->regenerate();

        return true;
    }

    public function delete($id) {
        return $this->userRepository->delete($id);
    }

    public function restore($id) {
        return $this->userRepository->restore($id);
    }
}
