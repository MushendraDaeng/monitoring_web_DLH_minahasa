<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trackings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('driver_id');
            $table->uuid('truck_id')->nullable();
            $table->uuid('route_id');
            $table->dateTime('act_date');
            $table->dateTime('start_time')->nullable();
            $table->dateTime('stop_time')->nullable();
            $table->string('start_location')->nullable();
            $table->string('stop_location')->nullable();
            $table->text('geolocation_col')->nullable();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trackings');
    }
}