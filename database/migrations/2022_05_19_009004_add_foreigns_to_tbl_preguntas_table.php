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
        Schema::table('tbl_preguntas', function (Blueprint $table) {
            $table
                ->foreign('idExamen')
                ->references('id')
                ->on('tblexamenes')
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
        Schema::table('tbl_preguntas', function (Blueprint $table) {
            $table->dropForeign(['idExamen']);
        });
    }
};
