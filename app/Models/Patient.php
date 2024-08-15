<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Cviebrock\EloquentSluggable\Sluggable;
use Nicolaslopezj\Searchable\SearchableTrait;


class Patient extends Model
{
    use SoftDeletes, SearchableTrait;//Sluggable,

    protected $dates =['deleted_at'];

    protected $guarded = [];
    protected $searchable = [
        'columns' => [
            'patients.patient_name' => 10,
            'patients.age' => 10,
            'patients.gender' =>10,
            'patients.phone' => 10
        ],
    ];

    // public function sluggable(): array
    // {
    //     return [
    //         'patient_slug' => [
    //             'source' => 'patient_name'
    //         ]
    //     ];
    // }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function patientReviews()
    {
        return $this->hasMany(PatientReview::class ,'patient_id');
    }
}
