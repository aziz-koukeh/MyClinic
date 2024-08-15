<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->integer('patient_review_id')->unsigned()->nullable();
            $table->integer('doctor_id')->unsigned()->nullable();

            $table->unsignedTinyInteger('done')->default(0);
            $table->unsignedTinyInteger('ch_d')->default(0);// تم المعالجة
            $table->unsignedTinyInteger('re_it')->default(0); // تم الكشف
            $table->unsignedTinyInteger('special_with_star')->default(0);

            $table->unsignedTinyInteger('leave_off')->default(0);
            $table->string('review_type');//نوع الزيارة
            $table->longText('main_complaint')->nullable()->index();//الشكاية الرئيسية
            $table->longText('med_analysis_T')->nullable();//التحليل مكتوب
            $table->longText('med_photo_T')->nullable();//الصورة مكتوب
            $table->longText('pain_story')->nullable()->index();//القصة المرضية
            $table->longText('medical_report')->nullable()->index();//تقرير فحص الطبيب
            $table->longText('treatment_plan')->nullable()->index();//خطة العلاج
            $table->longText('doctor_notes')->nullable();//ملاحظات الطبيب
            $table->timestamp('date_expecting')->nullable();// التاريخ المتوقع للزيارة القادمة
            $table->timestamp('review_forDay')->nullable();
            $table->bigInteger('wages')->nullable()->default(0);//الأجور

            $table->softDeletes();
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
        Schema::dropIfExists('patient_reviews');
    }
}
