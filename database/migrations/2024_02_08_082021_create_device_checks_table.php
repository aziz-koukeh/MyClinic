<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviceChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_checks', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();// عائد لأي عيادة
            $table->string('userName')->nullable();// اسم المستخدم المخصص للجهاز
            $table->string('ip')->nullable();// ip لتسجيل الدخول
            $table->longText('userAgent')->nullable(); //  (المتصفح - نوع الجهاز - نوع المتصفح )معلومات المستخدم الذي قام بتسجيل الدخول
            $table->string('deviceType')->nullable(); // mobile - tablet - computer
            $table->string('deviceFamily')->nullable(); // sony -samsung - iphone - ......
            $table->string('deviceModel')->nullable();// xperia t2 - .....
            $table->string('platformName')->nullable();// windows 10 - android 5.0.2 - .....

            $table->string('browserName')->nullable(); // chrome - chrome mobile - opera - edge  - ...
            $table->string('browserEngine')->nullable(); // محرك البحث

            $table->unsignedTinyInteger('root');//  - الحذف ممنوع - حالة الجهاز
            $table->unsignedTinyInteger('state')->nullable();//  - محظور ممنوع - حالة الجهاز
            $table->unsignedTinyInteger('browser_state')->nullable();//  - محظور ممنوع - حالة الجهاز
            $table->integer('doctor_id')->unsigned();// عائد لأي عيادة
            $table->timestamp('last_seen')->nullable();// آخر ظهور
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
        Schema::dropIfExists('device_checks');
    }
}
