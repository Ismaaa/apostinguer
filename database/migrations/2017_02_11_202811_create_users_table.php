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
        Schema::create('usuari', function (Blueprint $table) {
            $table->increments('id_usuari');
            $table->timestamps();
            $table->string('usuari');
            $table->string('nom');
            $table->string('cognom');
            $table->string('dni');
            $table->string('correu');
            $table->string('dades_bancaries');
            $table->integer('telefon');
            $table->integer('diners');
            $table->string('password');
            $table->rememberToken();
        });

        Schema::create('subhasta', function (Blueprint $table) {
            $table->increments('id_subhasta');
            $table->timestamps();
            $table->string('producte');
            $table->string('dni');
            $table->string('estat');
            $table->string('descripcio');
            $table->integer('preu');
            $table->rememberToken();
        });

        Schema::create('imatges', function (Blueprint $table) {
            $table->increments('id_imatge');
            $table->timestamps();
            $table->string('ruta');
            $table->rememberToken();
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
        Schema::drop('subhasta');
        Schema::drop('imatges');
    }
}
