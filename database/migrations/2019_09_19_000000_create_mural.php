<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMural extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mural', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_users')->unsigned();
            $table->foreign('id_users')->references('id')->on('users')->onDelete('cascade');
            $table->string('nome');
            $table->string('texto');
            $table->integer('ativo')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mural');
    }
}