<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rab extends Model
{

    protected $table = 'rabs';

    protected $fillable = [
        'branch_id',
        'date',
        'month',
        'year'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public static function boot() {
        parent::boot();

        static::created(function($model) {
            CashFlow::create([
                'rab_id'    => $model->id,
                'branch_id' => $model->branch_id,
                'date'      => $model->date,
                'month'     => $model->month,
                'year'      => $model->year
            ]);
        });
    }

}