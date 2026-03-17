<?php

namespace App\Http\Repositories;
use Illuminate\Support\Facades\Redis;

class RedisRepository
{
    public function get($path) {
        return Redis::get($path);
    }

    public function set($path, $value) {
        Redis::set($path, $value);
    }

    public function delete($path) {
        Redis::set($path, '');
    }
}
