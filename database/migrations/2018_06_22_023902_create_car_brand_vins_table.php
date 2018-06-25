<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarBrandVinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_brand_vins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vin_prefix');
            $table->mediumInteger('brand_id');
            $table->string('brand_name');
            $table->string('db_name');
            $table->string('db_host');
            $table->mediumInteger('db_port')->default(3600);
            $table->string('index_name');
            $table->string('index_type')->nullable();
            $table->string('index_host')->default(9200);
            $table->mediumInteger('index_port');
            $table->tinyInteger('is_del')->default(0);
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
        Schema::dropIfExists('car_brand_vins');
    }
}
