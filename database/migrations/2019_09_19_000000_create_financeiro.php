<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanceiro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financeiros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_user')->unsigned();
            $table->string('nome');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->date('data_pag')->nullable();
            $table->string('mes');
            $table->string('valor');
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
        Schema::dropIfExists('financeiros');
    }
}