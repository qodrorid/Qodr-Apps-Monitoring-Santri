<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $table = 'surveys';

    protected $fillable = [
        'title',
        'author_id',
        'date_start',
        'date_end',
        'time_limit',
        'note'
    ];
    //
}
