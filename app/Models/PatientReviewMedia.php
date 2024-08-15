<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientReviewMedia extends Model
{
    protected $guarded = [];

    public function patReview()
    {
        return $this->belongsTo(PatientReview::class);
    }
}
