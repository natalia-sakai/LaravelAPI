<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cargo'); 
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

        DB::table('cargos')->insert([
            ['id'=>1, 'cargo'=>'Tesoureiro Adjunto'],
            ['id'=>2, 'cargo'=>'Mestre de Cerimonias'],
            ['id'=>3, 'cargo'=>'Tesoureiro'],
            ['id'=>4, 'cargo'=>'Venerável'],
            ['id'=>5, 'cargo'=>'Paste master'],
            ['id'=>6, 'cargo'=>'Primeiro Vigilante'],
            ['id'=>7, 'cargo'=>'Segundo Vigilante'],
            ['id'=>8, 'cargo'=>'Orador'],
            ['id'=>9, 'cargo'=>'Secretário'],
            ['id'=>10, 'cargo'=>'Harmonia'],
            ['id'=>11, 'cargo'=>'Banquetes'],
            ['id'=>12, 'cargo'=>'Cobridor'],
            ['id'=>13, 'cargo'=>'Cobridor Externo'],
            ['id'=>14, 'cargo'=>'Primeiro Diácono'],
            ['id'=>15, 'cargo'=>'Segundo Diácono'],
            ['id'=>16, 'cargo'=>'Experto I'],
            ['id'=>17, 'cargo'=>'Experto II'],
            ['id'=>18, 'cargo'=>'Chanceler'],
            ['id'=>19, 'cargo'=>'Porta Estandarte'],
            ['id'=>20, 'cargo'=>'Porta Espadas'],
            ['id'=>21, 'cargo'=>'Bibliotecário'],
            ['id'=>22, 'cargo'=>'Arquiteto'],
            ['id'=>23, 'cargo'=>'Hospitaleiro'],
            ['id'=>24, 'cargo'=>'Porta Bandeira'],
            ['id'=>25, 'cargo'=>'Nenhum']
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