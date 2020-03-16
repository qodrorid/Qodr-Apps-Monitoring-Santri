<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rab extends Model
{

    protected $table = 'rabs';

    protected $fillable = [
        'date',
        'month',
        'year'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

}