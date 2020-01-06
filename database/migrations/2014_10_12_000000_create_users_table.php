<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('endereco');
            $table->string('cidade');
            $table->string('estado');
            $table->date('data_nasc');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->bigInteger('cargo_id')->unsigned();
            $table->foreign('cargo_id')->references('id')->on('cargos')->onDelete('cascade');
            $table->string('profissao');
            $table->bigInteger('avental_id')->unsigned();
            $table->foreign('avental_id')->references('id')->on('avental')->onDelete('cascade');
            $table->string('telefone');
            $table->integer('nivel');
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
        Schema::dropIfExists('users');
    }
}
