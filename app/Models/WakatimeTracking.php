<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WakatimeTracking extends Model
{

    protected $table = 'wakatime_trackings';

    protected $fillable = [
        'user_id',
        'digital',
        'hours',
        'minutes',
        'text_duration',
        'date',
        'languages',
        'editors'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

}
