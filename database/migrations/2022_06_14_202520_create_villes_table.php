<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVillesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('villes');
        Schema::disableForeignKeyConstraints();
        Schema::create('villes', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('ville_code_postal')->nullable();
            $table->string('ville_longitude')->nullable();
            $table->string('ville_latitude')->nullable();
            $table->string('ville_longitude_grd')->nullable(); 
            $table->string('ville_latitude_grd')->nullable();
            $table->string('ville_longitude_dms')->nullable();
            $table->string('ville_latitude_dms')->nullable();  
            $table->string('ville_zmin')->nullable();
            $table->string('ville_zmax')->nullable();

            $table->unsignedBigInteger('pays_id');
            $table->foreign('pays_id')->references('id')->on('pays')->onUpdate('cascade')->onDelete('restrict');

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
        Schema::dropIfExists('villes');
    }
}
