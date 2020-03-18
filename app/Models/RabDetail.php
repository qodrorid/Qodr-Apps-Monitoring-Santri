<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RabDetail extends Model
{

    protected $table = 'rab_details';

    protected $fillable = [
        'rab_id',
        'for',
        'qty',
        'type',
        'price',
        'total'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

}
