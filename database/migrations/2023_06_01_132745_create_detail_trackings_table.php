<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTrackingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_trackings', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('truck_id');
            $table->uuid('driver_id');
            $table->uuid('activity_id');
            $table->dateTime('tracking_date');
            $table->text('geolocation_col');
            
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
        Schema::dropIfExists('detail_trackings');
    }
}