<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('fullname');
            $table->string('username')->unique()->nullable();
            $table->string('service_number')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('gender')->nullable();
            $table->string('directorate')->nullable();
            $table->dateTime('dob');
            $table->dateTime('doe');
            $table->integer('gl')->nullable();
            $table->string('category')->nullable();
            $table->boolean('isAdmin')->default(0);
            $table->boolean('isCDI')->default(0);
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
