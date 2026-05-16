<?php

namespace App\Http\Repositories;

use App\Models\Topics;

class TopicRepository
{
    public function get() {
        return Topics::all();
    }

    public function getById($id) {
        return Topics::findOrFail($id);
    }

    public function create($name) {
        Topics::create([
            'Name' => $name,
        ]);

        return 1;
    }

    public function update($id, $name) {
        $topic = $this->getById($id);
        $topic->name = $name;
        $topic->save();

        return 1;
    }

    public function delete($id) {
        Topics::destroy($id);

        return 1;
    }
}
