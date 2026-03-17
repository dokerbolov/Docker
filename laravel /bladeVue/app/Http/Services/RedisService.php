<?php

namespace App\Http\Services;

use App\Http\Repositories\RedisRepository;

class RedisService
{
    protected RedisRepository $redisRepository;
    protected $path;

    public function __construct(RedisRepository $redisRepository) {
        $this->redisRepository = $redisRepository;
        $this->path = 'test';
    }

    public function get($path = null) {
        $this->path = 'user:2';

        $items = $this->redisRepository->get($this->path);
        return json_decode($items);
    }

    public function set($value, $path = null) {
//        if($path) {
            $this->path = 'user:2';
//        }

        $items = [];
        $data = $this->get();

        if(isset($data)) {
            $items[] = $data;
        }

        $items[] = $value;

        $this->redisRepository->set($this->path, json_encode($items));
        return response()->json('success');
    }

    public function delete($path = null) {
        $this->path = 'user:2';

        $this->redisRepository->delete($this->path, '');
        return response()->json('success');
    }
}
