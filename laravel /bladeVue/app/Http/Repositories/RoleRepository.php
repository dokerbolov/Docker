<?php

namespace App\Http\Repositories;
use Spatie\Permission\Models\Role;

class RoleRepository
{
    public function get($page) {
        return Role::paginate(100, ['*'], 'page', $page);
    }

    public function getByName($name) {
        return Role::findByName($name);
    }

    public function getById($id) {
        return Role::findById($id);
    }

    public function create($name) {
        return Role::create([
            'name' => $name
        ]);
    }

    public function change($id, $name) {
        $role = Role::findById($id);
        $role->name = $name;
        $role->save();

        return $role;
    }

    public function delete($id) {
        return Role::destroy($id);
    }
}


