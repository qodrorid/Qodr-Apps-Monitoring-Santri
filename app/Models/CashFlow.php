<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashFlow extends Model
{

    protected $table = 'cash_flows';

    protected $fillable = [
        'rab_id',
        'branch_id',
        'date',
        'month',
        'year'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

}
