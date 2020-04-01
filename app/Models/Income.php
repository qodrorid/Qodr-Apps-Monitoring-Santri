<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    
    protected $fillable = [
        'user_id',
        'cash_flow_detail_id',
        'date',
        'name',
        'nominal',
        'information'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    
    public static function boot() {
        parent::boot();

        static::creating(function($model) {
            $cashFlowId     = CashFlow::whereMonth('date', date('m', strtotime($model->date)))->first()->id;
            $cashFlowDetail = CashFlowDetail::create([
                'cash_flow_id' => $cashFlowId,
                'date' => $model->date,
                'for' => $model->name . ' : ' . $model->information,
                'qty' => 1,
                'type' => 'people',
                'price' => $model->nominal,
                'debit' => $model->nominal,
                'kredit' => 0,
            ]);

            $model->cash_flow_detail_id = $cashFlowDetail->id;

            return $model;
        });

        static::updating(function($model) {
            $cashFlowId     = CashFlow::whereMonth('date', date('m', strtotime($model->date)))->first()->id;
            $cashFlowDetail = CashFlowDetail::find($model->cash_flow_detail_id);

            $cashFlowDetail->update([
                'cash_flow_id' => $cashFlowId,
                'date' => $model->date,
                'for' => $model->name . ' : ' . $model->information,
                'qty' => 1,
                'type' => 'people',
                'price' => $model->nominal,
                'debit' => $model->nominal,
                'kredit' => 0,
            ]);

            return $model;
        });

        static::deleting(function($model) {
            $cashFlowDetail = CashFlowDetail::find($model->cash_flow_detail_id);
            $cashFlowDetail->delete();

            return $model;
        });
    
    }

}
