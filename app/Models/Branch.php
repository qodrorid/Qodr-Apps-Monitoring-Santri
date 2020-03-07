<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{

    use SoftDeletes;

    protected $table = 'branches';

    protected $fillable = [
        'name',
        'address'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function users()
    {
        return $this->hasMany('App\Models\User', 'id', 'branch_id');
    }
}
