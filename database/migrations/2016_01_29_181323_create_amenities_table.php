<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmenitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amenities', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('cats')->default(False);
            $table->boolean('dogs')->default(False);
            $table->boolean('dish_washer')->default(False);
            $table->boolean('doorman1')->default(False);
            $table->boolean('elevator1')->default(False);
            $table->boolean('furnished')->default(False);
            $table->boolean('gym')->default(False);
            $table->boolean('pool')->default(False);
            $table->boolean('laundry_unit1')->default(False);
            $table->boolean('laundry_building1')->default(False);
            $table->boolean('no_fee')->default(False);
            $table->boolean('private_outdoor1')->default(False);
            $table->boolean('common_outdoor')->default(False);
            $table->boolean('central_ac')->default(False);
            $table->boolean('fire_place')->default(False);
            $table->boolean('childrens_playroom')->default(False);
            $table->boolean('concierge')->default(False);
            $table->boolean('live_in_super')->default(False);
            $table->boolean('lounge')->default(False);
            $table->boolean('parking')->default(False);
            $table->boolean('storage_room')->default(False);
            $table->integer('property_id')->unsigned();
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
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
        Schema::drop('amenities');
    }
}
