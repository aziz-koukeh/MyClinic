<?php

namespace App\Exports;

use App\Models\PatientReview;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class PatientReviewsAllExport implements FromCollection , WithMapping , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $patientReviews = PatientReview::where('doctor_id',auth()->user()->doctor_id)->orderBy('created_at' , 'desc')->whereDone(1)->get();
        return $patientReviews;
    }

    public function map($patientReviews): array
    {
        return [
            $patientReviews->patient->patient_name,
            // $patientReviews->review_type,
            $patientReviews->main_complaint,
            $patientReviews->pain_story,
            $patientReviews->medical_report,
            $patientReviews->treatment_plan,
            $patientReviews->med_analysis_T,
            $patientReviews->med_photo_T,
            $patientReviews->doctor_notes,
            $patientReviews->date_expecting,
            $patientReviews->created_at->toDateString(),
        ];
    }

    public function headings(): array
    {
        return [
            'اسم المريض',
            // 'نوع الزيارة',
            'الشكوى الرئيسية',
            'القصة المرضية',
            'رأي الطبيب',
            'خطة العلاج',
            'التحليل مكتوب',
            'محتوى الصورة',
            'ملاحظات الطبيب',
            'الزيارة المتوقعة',
            'تاريخ الزيارة',
        ];
    }
}
