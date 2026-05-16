<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Results extends Model
{
    protected $connection = 'mysql';
    protected $table = 'results';
    protected $fillable = [
        'user_id',
        'questionnaire_id',
        'score',
        'room_id'
    ];
    public $timestamps = true;

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function questionnaire() {
        return $this->belongsTo(Questionnaire::class, 'questionnaire_id', 'id');
    }

    public function room() {
        return $this->belongsTo(BroadcastChannels::class, 'room_id', 'id');
    }
}
