<?php

namespace App\Http\Controllers;
rmativo;
use Illuminate\Http\Request;

class InformativoController extends Controller
{
    public function informativo(Request $request){
        $request->validate([
            'info' => 'required|string',
            'nivel' => 'required|int',
            'id_user' => 'required|int'
        ]);
        
        $info = new informativo;
        $info  -> id_user = $request->id_user;
        $info  -> info = $request->info;
        $info  -> ativo = 1;
        $info  -> nivel = $request->nivel;
        $info ->save();
    
        return response()->json($info -> id);
        
    }

    public function getinfo(){
        //recebe do bd o valor 
        $infoInfo=informativo::where('ativo', '1')->orderBy('updated_at', 'desc')->get();
        
        return response()->json($infoInfo);
    }

    public function getallinfo(){
        //recebe do bd o valor 
        $infoInfo=informativo::orderBy('updated_at', 'desc')->get();
        
        return response()->json($infoInfo);
    }

    public function getnivelinfo(Request $request){
        $request->validate([
            'nivel'=>'required|int',
            'tipo'=>'required|int'
        ]);
        if($request->tipo == 1){
            if($request->nivel == 1)
            {
                $Info=informativo::where(['nivel'=> 1, 'ativo'=>1])->take(3)->orderBy('updated_at', 'desc')->get();
                return response()->json($Info);
            }
            else if($request->nivel == 2){
                $Info=informativo::where([['ativo',1],['nivel','<=',2]])->take(3)->orderBy('updated_at', 'desc')->get();
                return response()->json($Info);
            }
            else if($request->nivel == 3){
                $Info=informativo::where('ativo',1)->take(3)->orderBy('updated_at', 'desc')->get();
                return response()->json($Info);
            }
        }
        else if($request->tipo == 0){
            if($request->nivel == 1)
            {
                $Info=informativo::where(['nivel'=> 1, 'ativo'=>1])->orderBy('updated_at', 'desc')->get();
                return response()->json($Info);
            }
            else if($request->nivel == 2){
                $Info=informativo::where([['ativo',1],['nivel','<=',2]])->orderBy('updated_at', 'desc')->get();
                return response()->json($Info);
            }
            else if($request->nivel == 3){
                $Info=informativo::where('ativo',1)->orderBy('updated_at', 'desc')->get();
                return response()->json($Info);
            }
        }
    }
    
    public function updateinfo(Request $request){
        $request->validate([
            'id'=>'required|int',
            'info'=>'required|string',
            'ativo'=>'required|int'
        ]);
        $resposta = informativo::where('id', $request->id)->update(['info'=>$request->info, 'ativo'=>$request->ativo]);
        if($resposta == null)
            return response()->json(['message' => 'Erro!'], 201);
        else
            return response()->json(['message' => 'Informativo Atualizado!'], 201);
    }

    public function deletehistinfo(){
        $info =  informativo::where('ativo', 0)->delete();
    }
}
