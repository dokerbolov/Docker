<?php

namespace App\Http\Repositories;

use App\Models\QuestionsAnswers;

class QuestionsAnswersRepository
{
    public function get() {
        return QuestionsAnswers::all();
    }

    public function getById($id) {
        return QuestionsAnswers::findOrFail($id);
    }

    public function create($name, $topic_id, $right_answer) {
        QuestionsAnswers::create([
            'Name' => $name,
            'question_id' => $topic_id,
            'right_answer' => $right_answer
        ]);

        return 1;
    }

    public function update($id, $name = null, $question_id = null, $right_answer = null) {
        $question_answer = QuestionsAnswers::where('id', '=', $id)->first();
        $question_answer->Name = !is_null($name) ? $name : $question_answer->Name;
        $question_answer->question_id = !is_null($question_id) ? $question_id : $question_answer->question_id;
        $question_answer->right_answer = !is_null($right_answer) ? $right_answer : $question_answer->right_answer;
        $question_answer->save();

        return 1;
    }

    public function delete($id) {
        QuestionsAnswers::destroy($id);

        return 1;
    }
}
