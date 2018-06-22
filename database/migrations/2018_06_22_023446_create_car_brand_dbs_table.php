<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarBrandDbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_brand_dbs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('brand_id');
            $table->string('brand_name');
            $table->string('db_name');
            $table->string('db_address');
            $table->string('db_port');
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
        Schema::dropIfExists('car_brand_dbs');
    }
}
