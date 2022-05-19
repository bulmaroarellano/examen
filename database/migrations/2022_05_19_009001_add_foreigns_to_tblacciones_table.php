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
        Schema::table('tblacciones', function (Blueprint $table) {
            $table
                ->foreign('bitacora_id')
                ->references('id')
                ->on('tblbitacoras')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tblacciones', function (Blueprint $table) {
            $table->dropForeign(['bitacora_id']);
        });
    }
};
