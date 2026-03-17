<?php

namespace App\Http\Services;

use App\Http\Repositories\RoleRepository;

class RoleService
{
    public RoleRepository $roleRepository;

    public function __construct(RoleRepository $roleRepository) {
        $this->roleRepository = $roleRepository;
    }

    public function get($page) {
        return $this->roleRepository->get($page);
    }

    public function getByName($name) {
        return $this->roleRepository->getByName($name);
    }

    public function getById($id) {
        return $this->roleRepository->getById($id);
    }

    public function create($name) {
        return $this->roleRepository->create($name);
    }

    public function change($id, $name) {
        return $this->roleRepository->change($id, $name);
    }

    public function delete($id) {
        return $this->roleRepository->delete($id);
    }
}
