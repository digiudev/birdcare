<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBirdsLevel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('birds_level', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('id_user');
            $table->integer('id_padre');
            $table->integer('id_madre');
            $table->tinyInteger('level_user');
            $table->integer('level_generic');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('birds_level');
    }
}
