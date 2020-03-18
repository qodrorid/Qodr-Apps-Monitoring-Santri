<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{

    protected $fillable = [
        'user_id',
        'cash_flow_detail_id',
        'name',
        'information',
        'borrowed_date',
        'refund_date'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

}