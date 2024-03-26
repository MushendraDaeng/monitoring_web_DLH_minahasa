<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_kategori');
            $table->uuid('id_sub_kategori');
            $table->string('name', 50);
            $table->string('urban_village', 50);
            $table->string('sub_district', 50);
            $table->enum('status', ['Berlangganan', 'Berhenti Berlangganan'])->default('Berlangganan');
            $table->bigInteger('tarif');
            $table->double('latitude');
            $table->double('longitude');

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
        Schema::dropIfExists('customers');
    }
}