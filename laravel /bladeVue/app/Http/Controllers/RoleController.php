<?php

namespace App\Http\Controllers;

use App\Http\Repositories\RoleRepository;
use App\Http\Services\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected RoleService $roleService;

    public function __construct(RoleService $roleService) {
        $this->roleService = $roleService;
    }

    public function get(Request $request) {
        $page = $request->input('page');
        return $this->roleService->get($page);
    }

    public function getByName(Request $request) {
        $request->validate(['string']);
        return $this->roleService->getByName($request->input('name'));
    }

    public function getById(Request $request) {
        $request->validate(['int']);
        return $this->roleService->getById($request->input('id'));
    }

    public function create(Request $request) {
        $request->validate(['string']);
        return $this->roleService->create($request->input('name'));
    }

    public function change(Request $request) {
        return $this->roleService->change($request->input('id'), $request->input('name'));
    }

    public function delete(Request $request) {
        $request->validate(['int']);
        return $this->roleService->delete($request->input('id'));
    }
}
