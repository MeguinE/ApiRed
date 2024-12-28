<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socios', function (Blueprint $table) {
            $table->id('id_socio');
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('domicilio');
            $table->string('correo_electronico')->unique();
            $table->string('telefono');
            $table->string('rnt');
            $table->string('rfc');
            $table->string('empresa');
            $table->string('lugar_desarrollo');
            $table->string('estado');
            $table->string('usuario')->unique();
            $table->string('contrasena');
            $table->string('rol');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};