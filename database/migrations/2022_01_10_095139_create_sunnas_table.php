<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSunnasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sunnas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('daily_record_id')->nullable();
            $table->foreign('daily_record_id')->references('id')->on('daily_records')->cascadeOnUpdate()->nullOnDelete();
            $table->string('book_name');
            $table->string('hadith_number');
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
        Schema::dropIfExists('sunnas');
    }
}
