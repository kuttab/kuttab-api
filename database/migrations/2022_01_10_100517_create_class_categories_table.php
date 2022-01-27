<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_categories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('class_id')->nullable();
            $table->bigInteger('category_id')->nullable();
            //TODO::set class_id cascadeOnDelete
            $table->foreign('class_id')->references('id')->on('classes')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnUpdate()->nullOnDelete();
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
        Schema::dropIfExists('class_categories');
    }
}
