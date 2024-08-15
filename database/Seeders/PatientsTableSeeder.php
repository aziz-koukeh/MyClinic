<?php
namespace Database\Seeders;

use App\Models\Patient;
use App\Models\User;
use Faker\Factory;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class PatientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fake = Factory::create();
        $patients = [];
        $user = collect(User::all()->modelKeys());

        for ($i=0; $i < 300; $i++) {

            $gender =['male','female'];
            $genderArr=Arr::random($gender);
            $patient_job =['نجار','حداد','فران','مهندس','موظف','خياط','ديكور','كهربائي'];
            $patient_jobArr=Arr::random($patient_job);
            $smoking =['negative','positive','positive'];
            $smokingArr=Arr::random($smoking);
            $relationship =['single','single','married'];
            $relationshipArr=Arr::random($relationship);
            if ($relationship =='married') {
                $child_count =['1','2','3','4','5','6','7','8','9'];
                $child_countArr=Arr::random($child_count);
            }else{
                $child_countArr='';
            }
            $blood_type =['AB+','A+','B+','O+','O-','B-','A-','AB-'];
            $blood_typeArr=Arr::random($blood_type);
            $years = ['2010', '2009', '2008','2007', '2006', '2005','1988', '1989', '1991', '1992', '1993', '1994', '1995', '1996', '1997', '1998', '1999', '2000'];
            $newyears =['2023','2024'];

            $days = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28'];

            $months = [ '08', '09', '10', '11', '12'];

            $age =  Arr::random($years) . "-" . Arr::random($months) . "-" . Arr::random($days);
            $created_at =  Arr::random($newyears) ;
            if ($created_at == '2024') {

                $days1 = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28'];

                $months1 = ['01', '02'];

            } elseif ($created_at == '2023') {

                $days1 = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28'];

                $months1 = ['08', '09', '10', '11', '12'];

            }

            $created_at.= "-" . Arr::random($months1) . "-" . Arr::random($days1) . " 01:01:01";
            $patient_name=$fake->name;

            $patients[] =[
                'user_id'           => $user->random(),
                'patient_name'      => $patient_name,
                'patient_slug'      => Str::uuid()->toString(),
                'age'               => $age ,
                // 'age'               => Carbon::create($yearsrandom, $monthsrandom, $daysrandom, 1, 1, 1 ),
                'gender'            => $genderArr,
                'relationship'            => $relationshipArr,
                'child_count'            => $child_countArr,
                'smoking'            => $smokingArr,
                'phone'             => '+9639' . random_int(10000000, 99999999),
                'older_surgery'     => $fake->sentence(mt_rand(3,6),true),
                'older_sicky'       => $fake->sentence(mt_rand(3,6),true),
                'older_sensitive'   => $fake->sentence(mt_rand(3,6),true),
                'permanent_medic'   => $fake->sentence(mt_rand(3,6),true),
                'blood_type'        => $blood_typeArr,
                'patient_job'        => $patient_jobArr,
                'created_at'        => $created_at,
                'updated_at'        => $created_at,
            ];
        }
        $chunks = array_chunk($patients, 300);
        foreach ($chunks as $chunk) {
            Patient::insert($chunk);
        }
    }
}
