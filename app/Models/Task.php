<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];

    public function foruser()
    {
        return $this->belongsTo(User::class, 'forUser_id');
    }
    public function donebyuser()
    {
        return $this->belongsTo(User::class, 'doneByUser_id');
    }
}
