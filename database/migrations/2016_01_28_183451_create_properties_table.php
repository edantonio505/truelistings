<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('address');
            $table->string('lng');
            $table->string('lat');
            $table->string('postal_code', 5);
            $table->string('suite');
            $table->string('slug');
            $table->string('neighborhood');
            $table->string('ref');
            $table->string('sale_type');
            $table->string('sale_sub_type');
            $table->integer('price');
            $table->integer('user_id');
            $table->text('description');
            $table->integer('beds')->default(1);
            $table->integer('baths')->default(1);
            $table->string('ft2')->nullable();
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
        Schema::drop('properties');
    }
}
