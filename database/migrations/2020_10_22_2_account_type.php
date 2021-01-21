<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AccountType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('account_type', function (Blueprint $table) {
            $table->increments('accTypeID');
            $table->string('typeName');
            $table->string('iconUrl')->nullable();
        });*/

        DB::table('account_type')->insert(
            array(
                [
                    'typeName' => 'Freelancer'
                ],
                [
                    'typeName' => 'Service'
                ],
                [
                    'typeName' => 'Others'
                ]
            )

        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_type');
    }
}
