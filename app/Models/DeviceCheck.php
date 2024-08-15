<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceCheck extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class );
    }
    public function device_belongsTo()
    {
        return $this->hasMany(DeviceCheck::class, 'device_id');
    }
    // <i class="fa-solid fa-house-laptop"></i>
    // <i class="fa-solid fa-laptop-medical"></i>
    // <i class="fa-solid fa-laptop"></i>
    // <i class="fa-solid fa-tablet-screen-button"></i>
    // <i class="fa-solid fa-mobile-screen"></i>

    // <i class="fa-solid fa-computer"></i>

    // <i class="fa-solid fa-house-lock"></i>
    // <i class="fa-solid fa-unlock-keyhole"></i>

    // <i class="fa-solid fa-shield-halved"></i>
    // <i class="fa-solid fa-user-shield"></i>

    // <i class="fa-solid fa-user-doctor"></i>
    // <i class="fa-solid fa-user-nurse"></i>

    // <i class="fa-solid fa-ban"></i> block
    // <i class="fa-regular fa-circle-xmark"></i>

    // <i class="fa-regular fa-circle-check"></i> allow

    // <i class="fa-regular fa-circle-pause"></i>
}
