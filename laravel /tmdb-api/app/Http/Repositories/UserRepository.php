<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getAll()
    {
        return User::all();
    }
    public function findById(int $id)
    {
        return User::findOrFail($id);
    }
    public function create(array $data)
    {
        return User::create($data);
    }
}
