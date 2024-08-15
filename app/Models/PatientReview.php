<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class PatientReview extends Model
{
    use SoftDeletes ,SearchableTrait;

    protected $dates =['deleted_at'];

    protected $guarded = [];

    protected $searchable = [
        'columns' => [
            'patient_reviews.main_complaint' => 10,
            'patient_reviews.pain_story' => 10,
            'patient_reviews.medical_report' =>10,
            'patient_reviews.treatment_plan' => 10
        ],
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

     public function outsideReviews()
    {
        return $this->belongsTo(PatientReview::class,  'patient_review_id');
    }
    public function insideReviews()
    {
        return $this->hasMany(PatientReview::class)->whereNotNull('patient_review_id');
    }
    public function reviewMedias()
    {
        return $this->hasMany(PatientReviewMedia::class ,'patient_reviews_id');
    }
}
