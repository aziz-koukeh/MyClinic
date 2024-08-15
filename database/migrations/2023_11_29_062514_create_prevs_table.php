<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrevsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prevs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            //Options-----------
            $table->unsignedTinyInteger('addPatient')->default(1);
            $table->unsignedTinyInteger('editPatient')->default(1);
            $table->unsignedTinyInteger('deletePatient')->default(1);
            $table->unsignedTinyInteger('destroyPatient')->default(0);
            //-----------------------
            $table->unsignedTinyInteger('addReview')->default(1);
            $table->unsignedTinyInteger('editReview')->default(1);
            $table->unsignedTinyInteger('deleteReview')->default(1);
            $table->unsignedTinyInteger('destroyReview')->default(0);
            //-----------------------
            $table->unsignedTinyInteger('addUser')->default(0);
            $table->unsignedTinyInteger('editUser')->default(0);
            $table->unsignedTinyInteger('destroyUser')->default(0);
            $table->unsignedTinyInteger('givePrev')->default(0);
            //-----------------------
            $table->unsignedTinyInteger('changeClinicSettings')->default(0);

            $table->unsignedTinyInteger('showPatientsAccounts')->default(0);

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
        Schema::dropIfExists('prevs');
    }
}
