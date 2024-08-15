<?php
namespace Database\Seeders;

use App\Models\Patient;
use App\Models\PatientReview;
use Faker\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class Patient_reviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $patient = collect(Patient::all()->modelKeys());
        $PatientReviews= [];


        for ($i=0; $i < 1000; $i++) {
            $special_with_star =['1','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0'];
            $special_with_starArr=Arr::random($special_with_star);

            $review_type= ['مراجعة','مراجعة','زيارة','زيارة','زيارة','اسعافية'];
            $review_typeArr= Arr::random($review_type);

            $main_complaint= ['اسعافية','اسعافية','اسعافية',
            ' - مراجعة - تحليل' ,'مراجعة',' - مراجعة - صورة - تحليل',' - مراجعة - صورة',' - مراجعة - تحليل' ,'مراجعة',' - مراجعة - صورة - تحليل',' - مراجعة - صورة',
            ' - مراجعة عملية - تحليل' ,'مراجعة عملية',' - مراجعة عملية - صورة - تحليل',' - مراجعة عملية - صورة',' - مراجعة عملية - تحليل' ,'مراجعة عملية',' - مراجعة عملية - صورة - تحليل',' - مراجعة عملية - صورة',
            ' - تحديد عملية - تحليل' ,'تحديد عملية',' - تحديد عملية - صورة - تحليل',' - تحديد عملية - صورة',' - تحديد عملية - تحليل' ,'تحديد عملية',' - تحديد عملية - صورة - تحليل',' - تحديد عملية - صورة',
            ];
            $main_complaintArr= Arr::random($main_complaint);

            $newyears =['2023','2023','2023','2023','2023','2024','2024','2024'];

            $created_at =  Arr::random($newyears) ;
            if ($created_at == '2024') {
                $days1 = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28'];
                $months1 = ['01', '02'];
            } elseif ($created_at == '2023') {
                $days1 = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28'];
                $months1 = [ '08', '09', '10', '11', '12'];
            }
            $created_at.= "-" . Arr::random($months1) . "-" . Arr::random($days1) . " 01:01:01";
            $patient_id=$patient->random();
            $PatientViews= PatientReview::create([
                'patient_id'     => $patient_id,
                'doctor_id'      => 1,
                'review_type'    =>'معاينة',
                'main_complaint'    =>'معاينة جديدة',
                // 'main_complaint' =>$faker->paragraph(),
                'med_analysis_T' =>$faker->paragraph(),
                'med_photo_T' =>$faker->paragraph(),
                'pain_story'     =>$faker->paragraph(2,true),
                'done'           => 1,
                'special_with_star'           =>  $special_with_starArr,
                'medical_report' =>$faker->paragraph(),
                'treatment_plan' =>$faker->paragraph(2,true),
                'doctor_notes' =>$faker->paragraph(2,true),
                'created_at'        => $created_at,
                'updated_at'        => $created_at,

            ]);
            $PatientReviews[]=[
                'patient_id'     =>$patient_id,
                'patient_review_id'      =>$PatientViews->id,
                'doctor_id'      => 1,
                'review_type'    =>$review_typeArr,
                'main_complaint'    =>$main_complaintArr,
                // 'main_complaint' =>$faker->paragraph(),
                'med_analysis_T' =>$faker->paragraph(),
                'med_photo_T' =>$faker->paragraph(),
                'pain_story'     =>$faker->paragraph(2,true),
                'done'           => 1,
                'medical_report' =>$faker->paragraph(),
                'treatment_plan' =>$faker->paragraph(2,true),
                'doctor_notes' =>$faker->paragraph(2,true),
                'created_at'        => $created_at,
                'updated_at'        => $created_at,

            ];
        }
        $chunks = array_chunk($PatientReviews, 300);
        foreach ($chunks as $chunk) {
            PatientReview::insert($chunk);
        }
    }
}
