<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellingPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selling_points', function (Blueprint $table) {
            $table->boolean('character')->default(False);
            $table->boolean('chefs_kitchen')->default(False);
            $table->boolean('closet_space')->default(False);
            $table->boolean('doorman1')->default(False);
            $table->boolean('elevator1')->default(False);
            $table->boolean('laundry_building1')->default(False);
            $table->boolean('laundry_unit1')->default(False);
            $table->boolean('low_floor')->default(False);
            $table->boolean('luxury_building')->default(False);
            $table->boolean('modern')->default(False);
            $table->boolean('natural_light')->default(False);
            $table->boolean('newly_renovated')->default(False);
            $table->boolean('private_outdoor1')->default(False);
            $table->boolean('proximity_subway')->default(False);
            $table->boolean('quiet_peaceful')->default(False);
            $table->boolean('views')->default(False);
            $table->boolean('size')->default(False);
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
        Schema::drop('selling_points');
    }
}
