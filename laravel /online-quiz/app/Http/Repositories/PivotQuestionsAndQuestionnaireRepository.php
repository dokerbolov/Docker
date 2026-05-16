<?php

namespace App\Http\Repositories;

use App\Models\PivotQuestionsAndQuestionnaire;

class PivotQuestionsAndQuestionnaireRepository
{
    public function create($question_id, $questionnaire_id) {
        PivotQuestionsAndQuestionnaire::create([
            'question_id' => $question_id,
            'questionnaire_id' => $questionnaire_id,
        ]);

        return 1;
    }

    public function remove($question_id, $questionnaire_id) {
        $pivot = PivotQuestionsAndQuestionnaire::where('question_id', '=', $question_id)
            ->where('questionnaire_id', '=', $questionnaire_id)
            ->first();
        $pivot->delete();

        return 1;
    }

    public function delete($id) {
        PivotQuestionsAndQuestionnaire::destroy($id);

        return 1;
    }
}
