<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuraanAchievementTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quraan_achievement_types', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->string('name');
            $table->softDeletes();
            $table->timestamps();
        });

        // Insert some stuff

        DB::table('quraan_achievement_types')->upsert([
            ['name' => 'memorize'],
            ['name' => 'revise'],
            ['name' => 'recite']
        ],['name']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quraan_achievement_types');
    }
}
