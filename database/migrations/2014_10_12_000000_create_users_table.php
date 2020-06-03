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
            $table->string('servicename')->nullable();
            $table->string('fullname')->nullable();
            $table->string('username')->nullable();
            $table->string('service_number')->nullable();
            $table->string('password')->nullable();
            $table->string('gender')->nullable();
            $table->string('directorate')->nullable();
            $table->dateTime('dob');
            $table->dateTime('doe');
            $table->string('soo')->nullable();
            $table->string('lgoo')->nullable();
            $table->integer('gl')->nullable();
            $table->string('category')->nullable();
            $table->integer('queries')->default(0);
            $table->integer('commendations')->default(0);
            $table->boolean('isAdmin')->default(0);
            $table->boolean('isTraining')->default(0);
            $table->boolean('isDirector')->default(0);
            $table->boolean('isCDI')->default(0);
            $table->string('passport')->nullable();
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
