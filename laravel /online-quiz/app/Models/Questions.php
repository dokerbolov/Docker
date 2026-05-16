<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $connection = 'mysql';
    protected $table = 'questions';
    protected $fillable = [
        'Name',
        'topic_id'
    ];
    public $timestamps = true;

    public function topics() {
        return $this->belongsTo(Topics::class, 'topic_id', 'id');
    }

    public function answers(){
        return $this->hasMany(QuestionsAnswers::class, 'question_id', 'id');
    }

    public function questionnaire() {
        return $this->hasManyThrough(
            Questionnaire::class,
            PivotQuestionsAndQuestionnaire::class,
            'question_id',
            'id',
            'id',
            'questionnaire_id');
    }
}
