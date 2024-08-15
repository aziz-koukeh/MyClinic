<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientReviewMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_review_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_reviews_id')->constrained()->onDelete('cascade');



            $table->string('file_name');
            $table->string('file_type')->nullable();
            $table->string('file_size')->nullable();

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
        Schema::dropIfExists('patient_review_media');
    }
}
