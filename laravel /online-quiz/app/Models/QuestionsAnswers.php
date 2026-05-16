<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionsAnswers extends Model
{
    protected $connection = 'mysql';
    protected $table = 'question_answers';
    protected $fillable = [
        'Name',
        'question_id',
        'right_answer'
    ];
    public $timestamps = true;

    public function questions() {
        return $this->belongsTo(Questions::class, 'id', 'question_id');
    }
}
