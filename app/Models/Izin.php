<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Izin extends Model
{

    use SoftDeletes;

    protected $table = 'izins';

    protected $fillable = [
        'user_id',
        'name',
        'information',
        'start',
        'end',
        'approved'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

}