<?php

namespace App\Http\Repositories;

use App\Models\User;

class UsersRepository
{
    public function get() {
        return User::with(['results'])->get();
    }

    public function getById($id) {
        return User::with(['results'])->where('id', '=', $id)->get();
    }
}
