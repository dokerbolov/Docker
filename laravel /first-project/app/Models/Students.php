<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Students extends Model
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'group_id',
        'age',
    ];

    public function group() {
        return $this->belongsTo(
            UniGroup::class,
            'group_id',
            'id');
    }
}
