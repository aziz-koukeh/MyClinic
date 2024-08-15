<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Doctor_info;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder


{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin=User::create([
            'name'    => 'Abdul Aziz Koukeh',
            'username'    =>'abdulazizkoukeh' ,
            'email'    => 'abdulazizkoukeh@gmail.com',
            'mobile'     => '+963995595413',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('123123123'),
            'status' => 1,
            'd_o_e' => 1,
        ]);
        $admin->doctor_id =$admin->id;
        $admin->save();

        $doctor_info =Doctor_info::create([
            'user_id' => $admin->id ,
            'password' => bcrypt('123123123'),
            'lockWebSite' => 0 ,
        ]);

        $this->call(PatientsTableSeeder::class);
        $this->call(Patient_reviewsTableSeeder::class);
    }
}
