<?php

namespace App\Http\Controllers;

use App\Http\Repositories\RoleRepository;
use App\Http\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function get(): Collection {
        return $this->userService->get();
    }

    public function auth(Request $request): JsonResponse {
        $request->validate(['int']);

        try {
            $data = $this->userService->auth($request->input('id'));
        } catch (\Exception $exception) {
            return response()->json(['message' => 'something went wrong', 'data' => $exception], 409);
        }

        return response()->json(['message' => 'success', 'code' => 200, 'data' => $data]);
    }

    public function delete(Request $request) {
        $request->validate(['int']);

        try {
            $this->userService->delete($request->input('id'));
        } catch (\Exception $exception) {
            return response()->json(['message' => 'something went wrong', 'data' => $exception], 409);
        }

        return response()->json(['message' => 'success', 'code' => 200]);
    }

    public function restore(Request $request) {
        $request->validate(['int']);

        try {
            $this->userService->restore($request->input('id'));
        } catch (\Exception $exception) {
            return response()->json(['message' => 'something went wrong', 'data' => $exception], 409);
        }

        return response()->json(['message' => 'success', 'code' => 200]);
    }
}
