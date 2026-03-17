<?php

namespace App\Http\Repositories;

use App\Models\User;

class UserRepository
{
    public function get() {
        return User::withTrashed()->get();
    }

    public function delete($id) {
        return User::find($id)->delete();
    }

    public function restore($id) {
        return User::withTrashed()->find($id)->restore();
    }
}
