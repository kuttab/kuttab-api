<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToAttendanceReasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attendance_reasons', function (Blueprint $table) {
            $table->bigInteger('school_id')->nullable();
            $table->foreign('school_id')->references('id')->on('schools')->cascadeOnUpdate()->nullOnDelete();
        });

        DB::table('attendance_reasons')->upsert([
            ['title' => 'مرض'],
            ['title' => 'دراسة'],
            ['title' => 'مناسبة اجتماعية'],
            ['title' => 'نشاط عائلي'],
        ],['title']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attendance_reasons', function (Blueprint $table) {
            //
        });
    }
}
