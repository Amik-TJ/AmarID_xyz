<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CardRegistration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('card_registration', function (Blueprint $table) {
            $table->increments('cardID');
            $table->integer('userID');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('designation');
            $table->string('street');
            $table->string('zipcode');
            $table->string('city');
            $table->string('country');
            $table->string('company');
            $table->string('email_personal');
            $table->string('email_business');
            $table->string('phone_personal');
            $table->string('phone_business');
            $table->string('website');
            $table->integer('softID')->default('50');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card_registration');
    }
}
