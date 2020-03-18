<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashFlowDetail extends Model
{

    protected $table = 'cash_flow_details';

    protected $fillable = [
        'cash_flow_id',
        'date',
        'for',
        'qty',
        'type',
        'price',
        'debit',
        'kredit'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function dateIndo()
    {
        return date('d/m/Y', strtotime($this->date));
    }
    
}
