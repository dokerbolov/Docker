<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PivotQuestionsAndQuestionnaire extends Model
{
    protected $connection = 'mysql';
    protected $table = 'pivot_questions_and_questionnaire';
    protected $fillable = [
        'question_id',
        'questionnaire_id',
    ];
    public $timestamps = true;
}
