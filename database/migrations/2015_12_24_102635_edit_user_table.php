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
            $table->integer('id_country');
            $table->string('province');
            $table->string('city');
            $table->string('zip');
            $table->string('phone');
            $table->string('RNA');
            $table->string('breeding_name');
            $table->boolean('geolocalization');
            $table->boolean('visible');
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
            $table->dropColumn('id_country');
            $table->dropColumn('province');
            $table->dropColumn('city');
            $table->dropColumn('zip');
            $table->dropColumn('phone');
            $table->dropColumn('RNA');
            $table->dropColumn('breeding_name');
            $table->dropColumn('geolocalization');
            $table->dropColumn('visible');
        });
    }
}
