<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topics extends Model
{
    protected $connection = 'mysql';
    protected $table = 'topics';

    protected $fillable = [
        'Name',
    ];

    protected $primaryKey = 'id';
    public $timestamps = true;

//    public function questions() {
//        $this->hasMany(Questions::class, 'topic_id', 'id');
//    }
}
