<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersPerfil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_perfil', function (Blueprint $table) {
            $table->increments('cd_perfil');
            $table->string('ds_descricao')->unique();
            $table->enum('ic_excluido', ['0','1'])->nullable();
            $table->integer('cd_usuario_exclusao')->nullable();
            $table->datetime('dt_exclusao')->nullable();
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
        Schema::dropIfExists('users_perfil');
    }
}
