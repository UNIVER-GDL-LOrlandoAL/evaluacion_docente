<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MentorCoordinador extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentoresCoordinadores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->foreignId('grupo_id')->from('grupos');
            $table->foreignId('plantel_id')->from('planteles');
            $table->boolean('isMentor');
            $table->boolean('isCoordinador');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mentoresCoordinadores');
    }
}
