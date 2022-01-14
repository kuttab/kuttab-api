<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_records', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->string('type');
            $table->bigInteger('school_id')->nullable();
            $table->bigInteger('teacher_id')->nullable();
            $table->bigInteger('student_id')->nullable();
            $table->foreign('school_id')->references('id')->on('schools')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('teacher_id')->references('id')->on('users')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('student_id')->references('id')->on('users')->cascadeOnUpdate()->nullOnDelete();
            $table->date('date');
            $table->string('review');
            $table->integer('score');
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
        Schema::dropIfExists('daily_records');
    }
}
