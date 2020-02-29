<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilePengurus extends Model
{

    protected $table = 'profile_penguruses';

    protected $fillable = [
        'user_id',
        'name',
        'gender',
        'address'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

}
