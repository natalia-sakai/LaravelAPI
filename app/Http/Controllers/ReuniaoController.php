<?php

namespace App\Http\Controllers;

use App\Mail\Confirmation;
use App\Mail\Register;
use App\Reuniao;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class ReuniaoController extends Controller
{
    public function createreuniao($day){
        Carbon::setLocale('pt_BR');
        //pega a data atual
        $now =Carbon::now();
        //transforma em data
        $now = strtotime($now);
        $string = "+".$day." day";
        //soma a qtde de dias
        $data = strtotime($string, $now);
        //configura o formato
        $resul = date('Y-m-d', $data);
        
        //desativa reuniao antiga toda terça
        if($day == 6)
        {
            //pega a data do dia anterior
            $aux = strtotime("-1 day", $now);
            $antiga= date('Y-m-d', $aux);
            Reuniao::where('data',$antiga)->update(['ativo'=> 0]);
        }
        //verifica se ja tem uma reuniao nesse dia
        $verifica = Reuniao::where('data', $resul)->first();
        //se nao tiver
        if($verifica == null)
        {
            $reuniao = new Reuniao;
            $reuniao->data = $resul;
            $reuniao->ativo = 1;
            $reuniao->save();
            return response()->json([
                'message' => 'Reuniao criada!'
            ], 201);
        }
        else{
            return response()->json([
                'message' => 'Reuniao já marcada!'
            ], 201);
        }
        
    }

    public function reuniao(){
        //pega o dia da semana
        $atual = date('w');
        switch($atual){
            case 1: //segunda
                return $this->createreuniao(0);
                break;
            case 2:
                return $this->createreuniao(6);
                break;
            case 3:
                return $this->createreuniao(5);
                break;
            case 4:
                return $this->createreuniao(4);
                break;
            case 5:
                return $this->createreuniao(3);
                break;
            case 6:
                return $this->createreuniao(2);
                break;
            case 0: //domingo
                return $this->createreuniao(1);
                break;
        }
        
    }
    public function notificacao(){
        $info = User::select('email')->where('cargo_id','<',12)->get();
        for($i=0; $i<count($info); $i++)
        {
            Mail::to($info[$i])->send(new Confirmation()); 
            Mail::to($info[$i])->send(new Register());
        }

        return response()->json('emails enviados');
    }

    public function getreuniao(){
        //recebe do bd o valor 
        $reuniaoInfo=Reuniao::where('ativo', '1')->get();
        
        return response()->json($reuniaoInfo);
    }

    public function getallreuniao(){
        //recebe do bd o valor 
        $reuniaoInfo=Reuniao::where('ativo', '0')->get();
        
        return response()->json($reuniaoInfo);
    }

    public function createnewreuniao(Request $request){
        $request->validate([
            'data' => 'required|string'
        ]);
        $verifica = Reuniao::where('data', $request->data)->first();
        if($verifica == null){
            Reuniao::where(['ativo'=> 1])->update(['ativo'=> 0]);
            $reuniao = new Reuniao;
            $reuniao->data = $request->data;
            $reuniao->ativo = 1;
            $reuniao->save();
            return response()->json('Reuniao criada!');
        }
        else{
            return response()->json('Reuniao já marcada!');
        }
    }
}
