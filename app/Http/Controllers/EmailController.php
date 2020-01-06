<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassword;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
class EmailController extends Controller
{
    public function forgotpassword(Request $request) {
        $request->validate([
            'email'=> 'required|string'
        ]);
        $email= User::where('email', $request->email)->value('email');
        if($email != NULL)
        {
            $senha = rand(100000,999999);
            $password = bcrypt($senha);
            $info = User::where('email', $request->email)->update(['password'=> $password]);
            Mail::to($email)->send(new ForgotPassword($senha)); 
    
            return response()->json('E-mail cadastrado! Enviaremos uma mensagem para esse endereço');
        }
        else{
            return response()->json('E-mail não cadastrado!');
        }
    }
}
