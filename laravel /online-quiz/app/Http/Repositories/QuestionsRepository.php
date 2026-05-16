<?php

namespace App\Http\Repositories;

use App\Models\Questions;

class QuestionsRepository
{
    public function get() {
        return Questions::with(['answers'])->get();
    }

    public function getById($id) {
        return Questions::with(['answers'])->where('id', '=', $id)->get();
    }

    public function create($name, $topic_id) {
        Questions::create([
            'Name' => $name,
            'topic_id' => $topic_id
        ]);

        return 1;
    }

    public function update($id, $name = null, $topic_id = null) {
        $question = Questions::where('id', '=', $id)->first();
        $question->Name = !is_null($name) ? $name : $question->Name;
        $question->topic_id = !is_null($topic_id) ? $topic_id : $question->topic_id;
        $question->save();

        return 1;
    }

    public function delete($id) {
        Questions::destroy($id);

        return 1;
    }
}
