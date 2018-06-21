<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('');
            $table->string('type')->nullable();
            $table->string('contact')->nullable();
            $table->string('hand_phone')->nullable();
            $table->string('tech_ad')->nullable();
            $table->string('tel_phone')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->integer('login_times')->default(0);
            $table->integer('query_times')->default(0);
            $table->date('service_start')->nullable();
            $table->date('service_expire')->nullable();
            $table->string('auth_time')->nullable();
            $table->string('auth_speed')->nullable();
            $table->integer('auth_number')->nullable();
            $table->string('auth_key')->nullable();
            $table->string('auth_ip')->nullable();
            $table->string('auth_brand')->nullable();
            $table->string('remarks')->nullable();
            $table->string('pics')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('operator_id')->default(0);
            $table->string('operator_name')->nullable();
            $table->timestamps();
            $table->index(['name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchants');
    }
}
