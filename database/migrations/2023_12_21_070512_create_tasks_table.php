<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->uuid('slug')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('forUser_id')->unsigned()->nullable(); // سوف سيوضع بداخله 0 للجماعة عوضا عن نول إلى حين تخصيص المشروع لشخص ما
            $table->integer('forGroup_id')->unsigned()->nullable(); // سوف سيوضع بداخله 0 للجماعة عوضا عن نول إلى حين تخصيص المشروع لشخص ما
            $table->integer('doneByUser_id')->unsigned()->nullable();
            $table->longText('contant');
            $table->string('icon')->nullable();
            $table->timestamp('forDay')->nullable();
            $table->timestamp('read_at')->nullable();
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
        Schema::dropIfExists('tasks');
    }
}
