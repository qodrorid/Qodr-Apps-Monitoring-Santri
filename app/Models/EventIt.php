<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventIt extends Model
{

    use SoftDeletes;

    protected $table = 'event_its';

    protected $fillable = [
        'title',
        'description',
        'participant',
        'start',
        'end',
        'budget'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

}
