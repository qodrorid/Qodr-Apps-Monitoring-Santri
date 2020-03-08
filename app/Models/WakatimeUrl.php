<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WakatimeUrl extends Model
{

    protected $table = 'wakatime_urls';

    protected $fillable = [
        'user_id',
        'coding_activity',
        'languages',
        'editors',
        'status'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

}