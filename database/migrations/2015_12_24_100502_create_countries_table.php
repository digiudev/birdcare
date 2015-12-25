<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('countries', function (Blueprint $table) {
                $table->increments('id');
                $table->string('sigla', 5);
                $table->float('lat', 10, 6);
                $table->float('lon', 10, 6);
                $table->string('nome', 255)->unique();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('countries');
    }
}
