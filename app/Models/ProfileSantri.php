<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileSantri extends Model
{

    protected $table = 'profile_santris';

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
