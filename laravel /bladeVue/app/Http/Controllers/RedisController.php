<?php

namespace App\Http\Controllers;

use App\Http\Services\RedisService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedisController extends Controller
{
    protected RedisService $redisService;

    public function __construct(RedisService $redisService) {
        $this->redisService = $redisService;
    }

    public function get() {
        $data = [
            'message' => 'List of test',
            'data' => $this->redisService->get()
        ];
        return response()->json($data);
    }

    public function create(Request $request) {
        $data = [
            'message' => $this->redisService->set($request->input('text'), Auth::id())
        ];

        return response()->json($data);
    }

    public function delete() {
        $data = [
            'message' => $this->redisService->delete(Auth::id())
        ];

        return response()->json($data);
    }
}
