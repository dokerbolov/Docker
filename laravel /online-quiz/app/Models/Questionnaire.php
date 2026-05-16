<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    protected $connection = 'mysql';
    protected $table = 'questionnaire';
    protected $fillable = [
        'Name',
        'rating',
        'is_active'
    ];
    public $timestamps = true;

    public function results() {
        return $this->hasMany(Results::class, 'questionnaire_id', 'id');
    }

    public function questions() {
        return $this->hasManyThrough(
            Questions::class,
            PivotQuestionsAndQuestionnaire::class,
            'questionnaire_id',
            'id',
            'id',
            'question_id');
    }
}
