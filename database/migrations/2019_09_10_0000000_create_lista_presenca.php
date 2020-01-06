<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListaPresenca extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lista_presencas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('reuniao')->unsigned();
            $table->foreign('reuniao')->references('id')->on('reuniao')->onDelete('cascade');
            $table->integer('presenca');
            $table->string('motivo');
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
        Schema::dropIfExists('lista_presencas');
    }
}