<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Field extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('field')->insert(
            array(
                [
                    'accTypeID' => 1,
                    'fieldName' => 'Other'
                ],
                [
                    'accTypeID' => 2,
                    'fieldName' => 'Other'
                ],
                [
                    'accTypeID' => 3,
                    'fieldName' => 'Other'
                ],
            )

        );
        /*Schema::create('field', function (Blueprint $table) {
            $table->increments('fieldID');
            $table->integer('accTypeID');
            $table->string('fieldName');
            $table->string('iconUrl')->nullable();
            //$table->foreign('accTypeID')->references('accTypeID')->on('account_type');
        });*/

        /*DB::table('field')->insert(
            array(
                [
                    'accTypeID' => 1,
                    'fieldName' => 'Developer'
                ],
                [
                    'accTypeID' => 1,
                    'fieldName' => 'Designer'
                ],
                [
                    'accTypeID' => 2,
                    'fieldName' => 'Grocery'
                ],
                [
                    'accTypeID' => 2,
                    'fieldName' => 'Repair'
                ],
                [
                    'accTypeID' => 1,
                    'fieldName' => 'Writer'
                ],
                [
                    'accTypeID' => 1,
                    'fieldName' => 'Marketing Professional'
                ],
                [
                    'accTypeID' => 3,
                    'fieldName' => 'Delivery'
                ],
                [
                    'accTypeID' => 3,
                    'fieldName' => 'Cleaning'
                ],
                [
                    'accTypeID' => 3,
                    'fieldName' => 'Fashion'
                ]

            )

        );*/
    }


    public function down()
    {
        Schema::dropIfExists('field');
    }
}
