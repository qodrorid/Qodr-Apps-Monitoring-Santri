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
        'nominal',
        'borrowed_date',
        'refund_date',
        'status'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public static function boot() {
        parent::boot();

        static::creating(function($model) {
            $cashFlowId     = CashFlow::whereMonth('date', date('m', strtotime($model->borrowed_date)))->first()->id;
            $cashFlowDetail = CashFlowDetail::create([
                'cash_flow_id' => $cashFlowId,
                'date' => $model->borrowed_date,
                'for' => $model->name . ' : ' . $model->information,
                'qty' => 1,
                'type' => 'people',
                'price' => $model->nominal,
                'debit' => 0,
                'kredit' => $model->nominal,
            ]);

            $model->cash_flow_detail_id = $cashFlowDetail->id;

            return $model;
        });

        static::updating(function($model) {
            $cashFlowId     = CashFlow::whereMonth('date', date('m', strtotime($model->borrowed_date)))->first()->id;
            $cashFlowDetail = CashFlowDetail::find($model->cash_flow_detail_id);

            if ($model->status) {
                CashFlowDetail::create([
                    'cash_flow_id' => $cashFlowId,
                    'date' => $model->borrowed_date,
                    'for' => $model->name . ' : ' . $model->information,
                    'qty' => 1,
                    'type' => 'people',
                    'price' => $model->nominal,
                    'debit' => $model->nominal,
                    'kredit' => 0,
                ]);
            } else {
                $cashFlowDetail->update([
                    'cash_flow_id' => $cashFlowId,
                    'date' => $model->borrowed_date,
                    'for' => $model->name . ' : ' . $model->information,
                    'qty' => 1,
                    'type' => 'people',
                    'price' => $model->nominal,
                    'debit'  => 0,
                    'kredit' => $model->nominal,
                ]);
            }

            return $model;
        });

        static::deleting(function($model) {
            $cashFlowDetail = CashFlowDetail::find($model->cash_flow_detail_id);
            $cashFlowDetail->delete();

            return $model;
        });
    }

}