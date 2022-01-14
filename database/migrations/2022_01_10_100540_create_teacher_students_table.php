<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_students', function (Blueprint $table) {
            $table->id();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->bigInteger('school_id')->nullable();
            $table->bigInteger('teacher_id')->nullable();
            $table->bigInteger('student_id')->nullable();
            $table->bigInteger('class_id')->nullable();
            $table->foreign('school_id')->references('id')->on('schools')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('teacher_id')->references('id')->on('users')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('student_id')->references('id')->on('users')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('class_id')->references('id')->on('classes')->cascadeOnUpdate()->nullOnDelete();
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
        Schema::dropIfExists('teacher_students');
    }
}
