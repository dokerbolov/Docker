<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BroadcastChannels extends Model
{
    protected $connection = 'mysql';
    protected $table = 'broadcast_channels';
    protected $fillable = [
        'room_id',
        'owner_id',
        'visibility',
        'questionnaire_id'
    ];
    public $timestamps = true;

    public function user() {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function questionnaire() {
        return $this->belongsTo(Questionnaire::class, 'questionnaire_id', 'id');
    }
}
