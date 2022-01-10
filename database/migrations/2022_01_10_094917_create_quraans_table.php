<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuraansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quraans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('daily_record_id')->nullable();
            $table->foreign('daily_record_id')->references('id')->on('daily_records')->cascadeOnUpdate()->nullOnDelete();
            $table->string('from_sura');
            $table->string('from_aya');
            $table->string('to_sura');
            $table->string('to_aya');
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
        Schema::dropIfExists('quraans');
    }
}
