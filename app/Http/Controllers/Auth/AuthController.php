<?php
namespace App\Http\Controllers\Auth;


use App\Models\Avental;
use App\Cargos;
use App\Familia;
use App\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\Welcome;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Mockery\HigherOrderMessage;

class AuthController extends Controller
{
    public function register(Request $request){
        //função de validacao de dados
        $request->validate([
            'fName' => 'required|string',
            'lName' => 'required|string',
            'endereco' => 'required|string',
            'cidade' => 'required|string',
            'estado' => 'required|string',
            'data_nasc' => 'required|date',
            'email' => 'required|string|email|unique:users',
            'cargo_id'  => 'required|integer',
            'avental_id'  => 'required|integer',
            'telefone' => 'required|string',
            'nivel' => 'required|int',
            'password' => 'required|string',
            'profissao'=> 'required|string'
        ]);
        
        //novo user
        $user = new User;
        //insere os dados
        $user->first_name = $request->fName;
        $user->last_name = $request->lName;
        $user->endereco = $request->endereco;
        $user->cidade = $request->cidade;
        $user->estado = $request->estado;
        $user->data_nasc = $request->data_nasc;
        $user->telefone = $request->telefone;
        $user->email = $request->email;
        $user->cargo_id = $request->cargo_id;
        $user->avental_id = $request->avental_id;
        $user->nivel = $request->nivel;
        $user->profissao = $request->profissao;
        $user->password = bcrypt($request->password);
        //salva o user
        $user->save();
        Mail::to($request->email)->send(new Welcome()); 
        $info = User::where('email', $request->email)->value('id');
        return response()->json($info);
    }

    public function login(Request $request) {
        /*para o login é preciso criar o token, precisa fazer:
        php artisan passport:install que ele dará um token e add no banco sozinho
        */
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me'=> 'boolean'
        ]);
        ///*
        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials))
            return response()->json(false);
        $user= Auth::user();
        $tokenResult = $user->createToken('Token de acesso pessoal');
        return response()->json($tokenResult);
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'id'=>$user->id,
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
        return response()->json(true);
    }
    
    public function logout(Request $request){
        $request->user()->token()->revoke();
        if($request == null)
            return response()->json([
                'message' => 'Logout falhou!'
            ]);
        else
            return response()->json([
            'message' => 'Logout feito com sucesso!'
            ]);
    }
    //validacao
    public function checkpassword(Request $request){
        $request->validate([
            'id_user'=> 'required|int',
            'password' => 'required|string'
        ]);
        $password = User::where('id', $request->id_user)->value('password');
        if(Hash::check($request->password, $password, []))
            return response()->json(true);
        else
            return response()->json(false);
    }

    

    public function familia(Request $request){
        $request->validate([
            'id_user'=>'required|int',
            'grau' => 'required|string',
            'data'=>'required|date'
        ]);
        $familia = new Familia;
        $familia ->id_users = $request->id_user;
        $familia ->data_nasc = $request->data;
        $familia ->grau = $request->grau;
        $familia ->save();
        return response()->json($familia);
    }
    public function updateuser(Request $request){
        $request->validate([
            'id_user'=> 'required|int',
            'fName' => 'required|string',
            'lName' => 'required|string',
            'email' => 'required|string|email',
            'endereco' => 'required|string',
            'cidade' => 'required|string',
            'estado' => 'required|string',
            'data_nasc' => 'required|date',
            'telefone' => 'required|string',
            'nivel' => 'required|int',
            'cargo' => 'required|int',
            'profissao' => 'required|string'
        ]);
        $resposta = User::where('id', $request->id_user)->update([
            'first_name'=> $request->fName, 'last_name'=> $request->lName, 'email'=>$request->email,
            'endereco' => $request->endereco, 'cidade'=> $request->cidade, 'estado'=>$request->estado,
            'data_nasc'=>$request->data_nasc, 'telefone'=>$request->telefone, 'nivel'=>$request->nivel,
            'cargo_id'=>$request->cargo, 'profissao'=>$request->profissao
        ]);
        if($resposta == null)
            return response()->json(false);
        else
            return response()->json(true);

    }

    public function updatepassword(Request $request){
        $request->validate([
            'id_user'=> 'required|int',
            'password' => 'required|string'
        ]);
        $password = bcrypt($request->password);
        $resposta = User::where('id', $request->id_user)->update(['password'=> $password]);
        if($resposta == null)
            return response()->json(['message' => 'Erro!'], 201);
        else
            return response()->json(['message' => 'Senha Atualizada!'], 201);
    }

    public function user(Request $request){
        return response()->json($request->user());
    }

    public function getusers(Request $request){
        $request->validate([
            'id_user'=>'required|int'
        ]);
        $resp = User::where('id', $request->id_user)->get();
        return response()->json($resp);
    }

    public function getbyemail(Request $request){
        $request->validate([
            'email'=>'required|string'
        ]);
        $resp = User::where('email', $request->email)->value('id');
        return response()->json($resp);
    }

    public function getusercargo(Request $request){
        $request->validate([
            'id'=>'required|int'
        ]);
        $resp = User::where('id', $request->id)->value('cargo_id');
        return response()->json($resp);
    }

    public function getalluser(){
        $info = User::select('id', 'profissao', 'telefone') ->orderBy('first_name', 'asc')->get();
        return response()->json($info);
    }

    public function getnome(Request $request){
        $request->validate([
            'id_user'=>'required|int'
        ]);
        $first = User::where('id', $request->id_user)->value('first_name');
        $last = User::where('id', $request->id_user)->value('last_name');
        $nome = $first." ".$last;
        $id = $request->id_user;
        return response()->json([$nome, $id]);
    }

    public function getcargos(){
        $cargoInfo=Cargos::get();
        return response()->json($cargoInfo);
    }

    public function getidcargos(Request $request){
        $request->validate([
            'id'=>'required|int'
        ]);
        $cargoInfo=Cargos::where('id', $request->id)->value('cargo');
        return response()->json($cargoInfo);
    }

    public function getavental(){
        $info=Avental::get();
        
        return response()->json($info);
    }

    public function getfamilia(Request $request){
        $request->validate([
            'id_user'=>'required|int'
        ]);
        $info = Familia::where('id_users', $request->id_user)->get();
        if($info == '[]'){
            return response()->json(0);
        }
        else{
            return response()->json($info);
        }
    }
}