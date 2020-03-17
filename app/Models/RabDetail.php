<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RabDetail extends Model
{

    use SoftDeletes;

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
        'updated_at',
        'deleted_at'
    ];
}
