<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('facebook_id')->unique();
            $table->string('twitter_id');
            $table->string('google_id')->unique();
            $table->string('handle')->unique();
            $table->string('avatar');
            $table->string('password', 60);
            $table->integer('idNazione');
            $table->integer('idRegione');
            $table->integer('idProvincia');
            $table->integer('idComune');
            $table->string('telefono');
            $table->string('RNA');
            $table->string('nome_allevamento');
            $table->boolean('geolocalicalizzazione');
            $table->boolean('visibile');
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
