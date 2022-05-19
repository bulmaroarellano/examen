<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblrespuestas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idPregunta');
            $table->string('desRespuesta');
            $table->boolean('correcta');
            $table->boolean('activo');

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
        Schema::dropIfExists('tblrespuestas');
    }
};
