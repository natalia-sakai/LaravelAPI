<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informativo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('info'); 
            $table->bigInteger('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->integer('nivel');
            $table->integer('ativo');
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
        Schema::dropIfExists('info');
    }
}