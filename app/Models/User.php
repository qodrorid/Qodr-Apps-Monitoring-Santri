<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// profile models
use App\Models\ProfilePengurus;
use App\Models\ProfileMitra;
use App\Models\ProfileSantri;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot() {
        parent::boot();

        static::saving(function($model) {
            $pengurus = [2, 3, 4, 5, 6, 7];
            $mitra    = 8;
            $santri   = 9;
    
            if (in_array($this->role_id, $pengurus)) {
                
            } else if ((int) $this->role_id === $mitra) {
                
            } else if ((int) $this->role_id === $santri) {
                
            }

            return $model;
        });
    }

    public function roleName()
    {
        return $this->role->name;
    }

    public function role()
    {
        return $this->belongsTo('App\Models\Role', 'role_id', 'id');
    }

    public function profile()
    {
        $pengurus = [2, 3, 4, 5, 6, 7];
        $mitra    = 8;
        $santri   = 9;

        if (in_array($this->role_id, $pengurus)) {
            return $this->hasOne('App\Models\ProfilePengurus', 'user_id', 'id');
        } else if ((int) $this->role_id === $mitra) {
            return $this->hasOne('App\Models\ProfileMitra', 'user_id', 'id');
        } else if ((int) $this->role_id === $santri) {
            return $this->hasOne('App\Models\ProfileSantri', 'user_id', 'id');
        } else  {
            return null;
        }
    }

    private function eventProfile(User $model, string $action)
    {
        $pengurus = [2, 3, 4, 5, 6, 7];
        $mitra    = 8;
        $santri   = 9;

        $data = [
            'user_id' => $model->id,
            'name'    => $model->name
        ];

        if (in_array($this->role_id, $pengurus)) {
            ProfilePengurus::$action($data);
        } else if ((int) $this->role_id === $mitra) {
            ProfileMitra::$action($data);
        } else if ((int) $this->role_id === $santri) {
            ProfileSantri::$action($data);
        }

        return $model;
    }
}
