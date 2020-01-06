<?php

namespace App\Http\Controllers;
use App\ListaPresenca;
use App\Reuniao;
use Illuminate\Http\Request;

class ListaController extends Controller
{
    public function listapresenca(Request $request){
        $request->validate([
            'id_user' => 'required|int',
            'presenca' => 'required|int',
            'motivo' => 'string',
            'reuniao'=>'required|int'
        ]);
        $lista = ListaPresenca::where(['id_user'=> $request->id_user, 'reuniao'=> $request->reuniao])->first();
        if($lista != null){
            ListaPresenca::where(['id_user'=> $request->id_user, 'reuniao'=> $request->reuniao])->update(['presenca'=> $request->presenca, 'motivo'=>$request->motivo]);
            return response()->json([
                'message' => 'Lista Atualizada!'
            ], 201);
        }
        else
        {
            $presenca = new ListaPresenca;
            $presenca -> id_user = $request->id_user;
            $presenca -> presenca = $request->presenca;
            $presenca -> motivo = $request->motivo;
            $presenca -> reuniao = $request->reuniao;
            $presenca->save();
        
            return response()->json([
                'message' => 'Novo usuário inserido na lista!'
            ], 201);
        }
    }
    public function updatelista(Request $request){
        $request->validate([
            'id'=>'required|int',
            'motivo'=>'required|string',
            'presenca'=>'required|int'
        ]);
        $reuniaoInfo=Reuniao::where('ativo', '1')->value('id'); 
        $listaInfo = ListaPresenca::where(['reuniao'=> $reuniaoInfo, 'id'=>$request->id])
                                    ->update(['motivo'=>$request->motivo, 'presenca'=>$request->presenca]);
        if($listaInfo == null){
            return response()->json(['message' => 'Erro!'], 201);
        }
        else
            return response()->json(['message' => 'Lista Atualizada!'], 201);
    }

    public function getlista(){
        $reuniaoInfo=Reuniao::where('ativo', '1')->value('id'); 
        $listaInfo = ListaPresenca::where('reuniao', $reuniaoInfo)->get();
        if($listaInfo != null)
            return response()->json($listaInfo);
        else
            return response()->json(" ");
    }

    public function getalllista(Request $request){
        $request->validate([
            'id'=>'required|int'
        ]);
        $listaInfo = ListaPresenca::where('reuniao', $request->id)->get();
        if($listaInfo != null)
            return response()->json($listaInfo);
        else
            return response()->json(" ");
    }

    public function getconfirmacao(Request $request){
        $request->validate([
            'tipo'=>'required|int'
        ]);
        $reuniaoInfo=Reuniao::where('ativo', '1')->value('id'); 
        if($request->tipo == 0){
            $presente = ListaPresenca::where('reuniao', $reuniaoInfo)->count();
            if($presente != null)
                return response()->json($presente);
            else
                return response()->json(0);  
        }
        else if($request->tipo == 1){
            $presente = ListaPresenca::where(['reuniao'=> $reuniaoInfo, 'presenca'=>1])->count();
            if($presente != null)
                return response()->json($presente);
            else
                return response()->json(0);
        }
        else if($request->tipo == 2){
            $ausente = ListaPresenca::where(['reuniao'=> $reuniaoInfo, 'presenca'=>0])->count();
            if($ausente != null)
                return response()->json($ausente);
            else
                return response()->json(0);
        }
    }
}
