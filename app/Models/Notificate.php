<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notificate extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function nforuser()
    {
        return $this->belongsTo(User::class, 'forUser_id');
    }
}
