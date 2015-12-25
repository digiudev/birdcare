<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table)
        {
            $table->integer('idCountry');
            $table->string('province');
            $table->string('city');
            $table->string('cap');
            $table->string('telefono');
            $table->string('RNA');
            $table->string('nome_allevamento');
            $table->boolean('geolocalizzazione');
            $table->boolean('visibile');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->dropColumn('idCountry');
            $table->dropColumn('province');
            $table->dropColumn('city');
            $table->dropColumn('cap');
            $table->dropColumn('telefono');
            $table->dropColumn('RNA');
            $table->dropColumn('nome_allevamento');
            $table->dropColumn('geolocalizzazione');
            $table->dropColumn('visibile');
        });
    }
}
