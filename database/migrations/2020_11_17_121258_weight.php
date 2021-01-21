<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Weight extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('weight')->insert(
            array(
                [
                    'weightID' => 1,
                    'weightName' => 'Basic'
                ],
                [
                    'weightID' => 2,
                    'weightName' => 'Standard'
                ],
                [
                    'weightID' => 3,
                    'weightName' => 'Premium'
                ],
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
        //
    }
}
