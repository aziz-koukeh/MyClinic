<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Mindscms\Entrust\Traits\EntrustUserWithPermissionsTrait;
// use Nicolaslopezj\Searchable\SearchableTrait;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;//, SearchableTrait , EntrustUserWithPermissionsTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function patients()
    {
        // if ($this->d_o_e == 1) {
            return $this->hasMany(Patient::class);
        // }
    }

    public function prev()
    {
        return $this->hasOne(Prev::class , 'user_id');

    }

    public function doctor_info()
    {
        // if ($this->d_o_e == 1) {
            return $this->hasOne(Doctor_info::class);
        // }
    }
    public function devices()
    {
        return $this->hasMany(DeviceCheck::class );
    }
}
