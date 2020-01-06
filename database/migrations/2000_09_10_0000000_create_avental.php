<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvental extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avental', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('avental'); 
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

        DB::table('avental')->insert([
            ['id'=>1, 'avental'=>'Aprendiz'],
            ['id'=>2, 'avental'=>'Companheiro'],
            ['id'=>3, 'avental'=>'Mestre']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cargos');
    }
}