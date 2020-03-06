<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

// profile models
use App\Models\ProfilePengurus;
use App\Models\ProfileMitra;
use App\Models\ProfileSantri;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

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
        'role_id',
        'branch_id'
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

        static::created(function($model) {
            return static::eventProfile($model, 'create');
        });

        static::updated(function($model) {
            return static::eventProfile($model, 'update');
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

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch', 'branch_id', 'id');
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

    private static function eventProfile(User $model, string $action)
    {
        $pengurus = [2, 3, 4, 5, 6, 7];
        $mitra    = 8;
        $santri   = 9;

        $data = [
            'user_id' => $model->id,
            'name'    => $model->name
        ];

        if ($action === 'create') {
            if (in_array((int) $model->role_id, $pengurus)) {
                ProfilePengurus::create($data);
            } else if ((int) $model->role_id === $mitra) {
                ProfileMitra::create($data);
            } else if ((int) $model->role_id === $santri) {
                ProfileSantri::create($data);
            }
        } else {
            if (in_array((int) $model->role_id, $pengurus)) {
                $profile = ProfilePengurus::where('user_id', $model->id)->first();
                $profile->update($data);
            } else if ((int) $model->role_id === $mitra) {
                $profile = ProfileMitra::where('user_id', $model->id)->first();
                $profile->update($data);
            } else if ((int) $model->role_id === $santri) {
                $profile = ProfileSantri::where('user_id', $model->id)->first();
                $profile->update($data);
            }
        }

        return $model;
    }
}
