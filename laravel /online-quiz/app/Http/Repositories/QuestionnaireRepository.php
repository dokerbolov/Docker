<?php

namespace App\Http\Repositories;

use App\Models\Questionnaire;

class QuestionnaireRepository
{
    public function get() {
        return Questionnaire::with(['questions'])->get();
    }

    public function getById($id) {
        return Questionnaire::with(['questions.answers'])->where('id', '=', $id)->first();
    }

    public function create($name, $rating, $is_active) {
        Questionnaire::create([
            'Name' => $name,
            'rating' => $rating,
            'is_active' => $is_active
        ]);

        return 1;
    }

    public function update($id, $name = null, $rating = null, $is_active = null) {
        $questionnaire = Questionnaire::where('id', '=', $id)->first();
        $questionnaire->Name = !is_null($name) ? $name : $questionnaire->Name;
        $questionnaire->rating = !is_null($rating) ? $rating : $questionnaire->rating;
        $questionnaire->is_active = !is_null($is_active) ? $is_active : $questionnaire->is_active;
        $questionnaire->save();

        return 1;
    }

    public function rate($id, $rating) {
        $questionnaire = Questionnaire::where('id', '=', $id)->first();
        $questionnaire->rating = $rating;
        $questionnaire->save();

        return 1;
    }

    public function delete($id) {
        Questionnaire::destroy($id);

        return 1;
    }
}
