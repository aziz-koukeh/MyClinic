<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('patient_slug')->unique();

            $table->string('patient_name')->index();
            $table->integer('age')->nullable()->index();
            $table->string('blood_type')->nullable();
            $table->string('gender')->index();
            $table->string('smoking')->nullable();
            $table->string('relationship')->nullable();
            $table->integer('child_count')->nullable();
            $table->string('phone')->nullable()->unique()->index();

            $table->longText('older_surgery')->nullable()->default('لا يوجد');
            $table->longText('older_sicky')->nullable()->default('لا يوجد');
            $table->longText('older_sensitive')->nullable()->default('لا يوجد');
            $table->longText('permanent_medic')->nullable()->default('لا يوجد');
            $table->longText('patient_state')->nullable()->default('لا يوجد');

            $table->string('patient_address')->nullable();
            $table->string('patient_job')->nullable();

            $table->string('photo')->nullable()->default('uploads/home/3.jpg');
            $table->bigInteger('account')->nullable();

            $table->softDeletes();
            $table->timestamps();

            // // Gyncologist  نسائية
            // $table->string('patient_father')->nullable();
            // $table->string('patient_mother')->nullable();
            // $table->string('patient_husband')->nullable();
            // $table->string('old_marry')->nullable();
            // $table->string('procreation_Un')->nullable();
            // $table->integer('child_male')->nullable();
            // $table->integer('child_female')->nullable();
            // $table->string('birth_way')->nullable();
            // Gyncologist  نسائية
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
