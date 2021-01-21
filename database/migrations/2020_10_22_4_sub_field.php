<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SubField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('sub_field', function (Blueprint $table) {
            $table->increments('subFieldID');
            $table->integer('fieldID');
            $table->string('subFieldName');
            $table->string('translation',255);
            //$table->foreign('fieldID')->references('fieldID')->on('field');
        });*/

        /*DB::table('sub_field')->insert(
            array(
                [
                    'fieldID' => 1,
                    'subFieldName' => 'Web Developer',
                    'translation' => 'freelancer, web site developer, website, web developer, freelancer, full stack developer, frontend developer, frontend, backend developer, full stack'
                ],
                [
                    'fieldID' => 2,
                    'subFieldName' => 'Graphics Designer',
                    'translation' => 'freelancer, ui, photoshop, graphics designer, illustrator, adobe photoshop, ui designer'
                ],
                [
                    'fieldID' => 3,
                    'subFieldName' => 'Beverages',
                    'translation' => 'Cold drinks, beverages,Drinks, Seven Up, Cocacola'
                ],
                [
                    'fieldID' => 4,
                    'subFieldName' => 'Car Repair',
                    'translation' => 'car repair, Car engine, Car Ac'
                ],
                [
                    'fieldID' => 4,
                    'subFieldName' => 'Gadgets Repair',
                    'translation' => 'gadgets repair, phone repair, display change, display, lock, charger, battery, data cable'
                ],
                [
                    'fieldID' => 4,
                    'subFieldName' => 'Appliance Repair',
                    'translation' => 'appliance repair, ac Repair, tv repair, washing machine repair, ac servicing'
                ],
                [
                    'fieldID' => 4,
                    'subFieldName' => 'Electric and Plumbing',
                    'translation' => 'electric and plumbing, electrician, electricity, plumber'
                ],
                [
                    'fieldID' => 5,
                    'subFieldName' => 'Content Writer',
                    'translation' => 'content writer, content creator, journalist, book writer'
                ],
                [
                    'fieldID' => 6,
                    'subFieldName' => 'Advertiser',
                    'translation' => 'advertiser, online marketing'
                ],
                [
                    'fieldID' => 7,
                    'subFieldName' => 'Delivery and Shifting',
                    'translation' => 'delivery and shifting, home change, office change, product delivery, delivery Man'
                ],
                [
                    'fieldID' => 8,
                    'subFieldName' => 'Cleaning and Pest Control',
                    'translation' => 'cleaning and pest control, home cleaning, office cleaning'
                ],
                [
                    'fieldID' => 9,
                    'subFieldName' => 'Beauty and Saloon',
                    'translation' => 'beauty and saloon, hair Saloon, beauty spa, beauty parlour'
                ]

            )

        );*/
    }


    public function down()
    {
        Schema::dropIfExists('sub_field');
    }
}
