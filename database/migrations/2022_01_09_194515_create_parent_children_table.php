<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentChildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parent_children', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent_id')->nullable();
            $table->bigInteger('child_id')->nullable();
            $table->bigInteger('school_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('users')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('child_id')->references('id')->on('users')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('school_id')->references('id')->on('schools')->cascadeOnUpdate()->nullOnDelete();
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
        Schema::dropIfExists('parent_children');
    }
}
