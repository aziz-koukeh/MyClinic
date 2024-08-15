<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('university')->nullable();
            $table->longText('med_specialty')->nullable();
            $table->longText('bio')->nullable();
            $table->string('exp_work_year')->nullable();
            $table->string('exp_about')->nullable();

            $table->bigInteger('v_wages')->nullable();
            $table->bigInteger('rev_wages')->nullable();
            $table->bigInteger('em_wages')->nullable();

            $table->longText('facepage')->nullable();
            $table->longText('whatsapp')->nullable();
            $table->longText('telegram')->nullable();
            $table->longText('instagram')->nullable();
            $table->longText('youtube')->nullable();
            $table->longText('twitter')->nullable();
            $table->longText('linked_in')->nullable();
            $table->longText('address')->nullable();
            $table->longText('map_emb')->nullable();
            $table->string('password');

            $table->unsignedTinyInteger('lockWebSite')->default(0);
            $table->time('opentime')->nullable();
            $table->time('closetime')->nullable();



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor_infos');
    }
}
