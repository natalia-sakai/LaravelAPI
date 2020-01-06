<?php

namespace App\Http\Controllers;
use App\Agape;
use Illuminate\Http\Request;

class AgapeController extends Controller
{
    public function agape(Request $request){
        $request->validate([
            'date' => 'required|string',
            'id_user' => 'required|int',
            'agape'=> 'required|string'
        ]);
        $agape = new Agape;
        $aux = $request->date;
        $data = strtotime($aux);
        $agape -> data = date('Y-m-d', $data);
        $agape -> id_user = $request->id_user;
        $agape -> agape = $request->agape;
        $agape -> ativo = 1;
        $agape->save();
        return response()->json($agape -> id);
    }
    public function updateagape(Request $request){
        $request->validate([
            'id'=>'required|int',
            'agape'=>'required|string',
            'ativo'=>'required|int',
            'date'=>'required|string'
        ]);
        $data = strtotime($request->date);
        $resul= date('Y-m-d', $data);
        $resposta = Agape::where('id', $request->id)->update(['agape'=>$request->agape, 'ativo'=>$request->ativo, 'data'=>$resul]);
        if($resposta == null)
            return response()->json(['message' => 'Erro!'], 201);
        else
            return response()->json(['message' => 'Ágape Atualizada!'], 201);
    }
    
    public function getagape(Request $request){
        $request->validate([
            'tipo'=>'required|int'
        ]);
        if($request->tipo == 1){
            $info=Agape::where('ativo', '1')->take(3)->orderBy('updated_at', 'desc')->get();
            return response()->json($info);
        }
        else if($request->tipo == 0){
            $info=Agape::where('ativo', '1')->orderBy('updated_at', 'desc')->get();
            return response()->json($info);
        }
    }

    public function getallagape(){
        $info=Agape::orderBy('updated_at', 'desc')->get();
        
        return response()->json($info);
    }

    public function deletehistagape(){
        $info =  Agape::where('ativo', 0)->delete();
    }
}
