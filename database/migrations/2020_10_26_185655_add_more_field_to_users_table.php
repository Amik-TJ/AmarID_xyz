<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreFieldToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::table('users', function (Blueprint $table) {
            //$table->increments('userID');
            //$table->string('username');
            $table->string('firstname');
            $table->string('lastname');
            //$table->string('email');
            $table->string('phone');
            //$table->string('password');
            $table->string('photo_url')->nullable();
            $table->string('firebaseID')->nullable();
            $table->string('deviceID')->nullable();
            $table->integer('accTypeID');
            $table->integer('fieldID');
            $table->integer('subFieldID');
            $table->string('location');
            $table->double('lat')->default('23.8103');
            $table->double('lon')->default('90.4125');
            $table->smallInteger('admin')->default('0');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
