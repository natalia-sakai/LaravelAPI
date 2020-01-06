<?php

namespace App\Http\Controllers;

use App\Mural;
use App\User;
use Illuminate\Http\Request;

class MuralController extends Controller
{
    public function mural(Request $request){
        $request->validate([
            'id_users'=>'required|int',
            'texto' => 'required|string'
        ]);
        $mural = new Mural;
        $mural -> id_users = $request->id_users;
        $mural -> texto = $request->texto;
        $first = User::where('id', $request->id_users)->value('first_name');
        $last = User::where('id', $request->id_users)->value('last_name');
        $nome = $first." ".$last;
        $mural -> nome = $nome;
        $mural -> save();
        return response()->json($mural -> id);
    }

    public function updatemural(Request $request){
        $request->validate([
            'id'=>'required|int',
            'texto'=>'required|string'
        ]);
        $resposta = Mural::where('id', $request->id)->update(['texto'=> $request->texto]);
        if($resposta == null)
            return response()->json(['message' => 'Erro!'], 201);
        else
            return response()->json(['message' => 'Mural Atualizado!'], 201);
    }

    //DELETES
    public function deletemural(Request $request){
        $request->validate([
            'id'=>'required|int'
        ]);
        Mural::where('id', $request->id)->delete();
        return response()->json(['message' => 'Mural Excluido!'], 201);
    }

    public function getmural(){
        $info=Mural::orderBy('updated_at', 'desc')->get();
        
        return response()->json($info);
    }

}
