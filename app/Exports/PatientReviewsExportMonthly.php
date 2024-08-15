<?php

namespace App\Exports;

use App\Models\PatientReview;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Carbon\Carbon;
class PatientReviewsExportMonthly implements FromQuery , WithMapping , WithHeadings
{
    use Exportable;


    public function forMonth($month)
    {
        $date = Carbon::createFromFormat('Y-m', $month);
        $formattedMonth = $date->format('m');
        $formattedYear = $date->format('Y');
        $this->month = $formattedMonth;
        $this->year = $formattedYear;

        return $this;
    }

    public function query()
    {
        return PatientReview::where('doctor_id',auth()->user()->doctor_id)->orderBy('created_at' , 'desc')->whereDone(1)->whereMonth('created_at', $this->month)->whereYear('created_at', $this->year);
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
