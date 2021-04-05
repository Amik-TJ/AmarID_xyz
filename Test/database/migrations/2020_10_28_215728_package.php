<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Package extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('packages', function (Blueprint $table) {
            $table->increments('packageID');
            $table->string('title');
            $table->string('description');
            $table->integer('hardCopyIncluded');
            $table->integer('oneSidedCard');
            $table->string('weight')->nullable();
            $table->integer('price');
            //$table->foreign('accTypeID')->references('accTypeID')->on('account_type');
        });

        DB::table('packages')->insert(
            array(
                [
                    'title' => 'Premium Plan',
                    'description' => 'Get 500 soft ID and 500 hard Copy',
                    'hardCopyIncluded' => 1,
                    'oneSidedCard' => 0,
                    'weight' => 'B,S,P',
                    'price' => 600
                ],
                [
                    'title' => 'Light plan',
                    'description' => '50 Hardcopy, 50 Soft copy',
                    'hardCopyIncluded' => 1,
                    'oneSidedCard' => 0,
                    'weight' => 'B,S,P',
                    'price' => 75
                ],
                [
                    'title' => 'Student plan',
                    'description' => '100 soft copies',
                    'hardCopyIncluded' => 0,
                    'oneSidedCard' => 1,
                    'weight' => null,
                    'price' => 20
                ],
                [
                    'title' => 'Light plan',
                    'description' => '50 single sided hard copy, 50 soft ID',
                    'hardCopyIncluded' => 1,
                    'oneSidedCard' => 1,
                    'weight' => 'B',
                    'price' => 60
                ]
            )

        );*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packages');
    }
}
