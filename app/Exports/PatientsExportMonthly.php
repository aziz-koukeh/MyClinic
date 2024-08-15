<?php

namespace App\Exports;

use App\Models\Patient;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Carbon\Carbon;
class PatientsExportMonthly implements FromQuery , WithMapping , WithHeadings
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
        return Patient::where('user_id',auth()->user()->doctor_id)->orderBy('created_at' , 'desc')->whereMonth('created_at', $this->month)->whereYear('created_at', $this->year);
    }


    public function map($patients): array
    {
        if ($patients->gender == 'male') {
            $gender = 'ذكر';
        }elseif ($patients->gender == 'female'){
            $gender = 'أنثى';
        }else{
            $gender = '';
        }
        if ((date('Y')- $patients->age) != date('Y') ) {
            $age = date('Y')- $patients->age . "سنة";
        }else{
            $age = '';
        }
        if ($patients->smoking == 'negative') {
            $smoking = 'سلبي';
        }elseif ($patients->smoking == 'positive'){
            $smoking = 'إيجابي';
        }else{
            $smoking = '';
        }

        if ($patients->relationship == 'married') {
            $relationship = 'متزوج/ة';
        }elseif ($patients->relationship == 'single'){
            $relationship = 'عازب/ة';
        }else{
            $relationship = '';
        }
        return [
            $patients->patient_name,
            $age,
            $gender,
            // $patients->blood_type,
            $relationship,
            $patients->child_count,
            $smoking,
            $patients->older_surgery,
            $patients->older_sicky,
            $patients->older_sensitive,
            $patients->permanent_medic,
            $patients->patient_state,
            $patients->patient_job,
            $patients->patient_address,
            $patients->phone,
            $patients->created_at->toDateString(),
        ];
    }

    public function headings(): array
    {
        return [
            'اسم المريض',
            'العمر',
            'الجنس',
            // 'زمرة الدم',
            'الحالة الإجتماعية',
            'عدد الأولاد',
            'التدخين',
            'السوابق الجراحية',
            'السوابق المرضية',
            'السوابق التحسسية',
            'الأدوية الدائمة',
            'حول المريض',
            'عمل المريض',
            'عنوان المريض',
            'رقم المريض',
            'تاريخ الزيارة',
        ];
    }
}
