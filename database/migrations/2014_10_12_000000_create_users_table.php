<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->uuid('uid');
            $table->string('username')->unique();
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('type');
            $table->bigInteger('school_id')->nullable();
            $table->string('nationality');
            $table->string('country');
            $table->string('city');
            $table->string('address');
            $table->date('birth_date');
            $table->bigInteger('mobile_number');
            $table->bigInteger('telephone_number');
            $table->string('image');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('academic');
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
