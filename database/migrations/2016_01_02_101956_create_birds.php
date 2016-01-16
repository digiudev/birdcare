<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBirds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('birds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user');
            $table->string('number');
            $table->enum('sex', ['M', 'F']);
            $table->integer('id_specie');
            $table->integer('id_padre');
            $table->integer('id_madre');
            $table->integer('id_cage');
            $table->integer('date_born');
            $table->integer('date_died');
            $table->integer('date_sale');
            $table->longText('note');
            $table->integer('last_modified');
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
        Schema::drop('birds');
    }
}
