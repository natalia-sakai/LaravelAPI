<?php

use App\Mail\ForgotPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//Route::get('get', 'UserController@get');//mostra todos os dados
/*
php artisan serve -- > para subir a aplicação
php artisan passport:install --> para criar o token de acesso 
*/
Route::prefix('info')->group(function () {
    //info
    Route::post('informativo', 'InformativoController@informativo');
    Route::get('getinfo', 'InformativoController@getinfo');
    Route::get('getallinfo', 'InformativoController@getallinfo');
    Route::post('getnivelinfo', 'InformativoController@getnivelinfo');
    Route::put('updateinfo', 'InformativoController@updateinfo');
    Route::get('deletehistinfo','InformativoController@deletehistinfo');
});

Route::prefix('ordem')->group(function () {
    //ordem
    Route::post('ordem', 'OrdemController@ordem');
    Route::get('getordem', 'OrdemController@getordem');
    Route::post('getnivelordem', 'OrdemController@getnivelordem');
    Route::get('getallordem', 'OrdemController@getallordem');
    Route::put('updateordem', 'OrdemController@updateordem');
    Route::get('deletehistordem','OrdemController@deletehistordem');
});

Route::prefix('financeiro')->group(function () {
    //financeiro
    Route::post('createfinanceiro', 'FinanceiroController@createfinanceiro');
    Route::get('getadminfinanceiro', 'FinanceiroController@getadminfinanceiro');
    Route::post('getfinanceiro', 'FinanceiroController@getfinanceiro');
    Route::post('getallfinanceiro', 'FinanceiroController@getallfinanceiro');
    Route::put('updatefinanceiro', 'FinanceiroController@updatefinanceiro');
});

Route::prefix('mural')->group(function () {
    //mural
    Route::post('mural', 'MuralController@mural');
    Route::get('getmural', 'MuralController@getmural');
    Route::put('updatemural', 'MuralController@updatemural');
    Route::put('deletemural', 'MuralController@deletemural');
});

Route::prefix('lista')->group(function () {
    //lista de presenca
    Route::post('listapresenca', 'ListaController@listapresenca');
    Route::get('getlista', 'ListaController@getlista');
    Route::post('getalllista', 'ListaController@getalllista');
    Route::put('updatelista', 'ListaController@updatelista');
    Route::post('getconfirmacao', 'ListaController@getconfirmacao');
});

Route::prefix('agape')->group(function () {
    //agape
    Route::post('agape', 'AgapeController@agape');
    Route::post('getagape', 'AgapeController@getagape');
    Route::get('getallagape', 'AgapeController@getallagape');
    Route::put('updateagape', 'AgapeController@updateagape');
    Route::get('deletehistagape','AgapeController@deletehistagape');
});

Route::prefix('reuniao')->group(function () {
   //reuniao
   Route::get('reuniao', 'ReuniaoController@reuniao');
   Route::get('getreuniao', 'ReuniaoController@getreuniao');
   Route::get('getallreuniao', 'ReuniaoController@getallreuniao');
   Route::get('notificacao', 'ReuniaoController@notificacao');
});

Route::prefix('email')->group(function () {
    Route::post('forgotpassword', 'EmailController@forgotpassword');
});
 

Route::prefix('auth')->group(function () {
    //login e register
    Route::post('login', 'Auth\AuthController@login')->name('login');
    Route::post('register', 'Auth\AuthController@register');
    Route::put('updateuser', 'Auth\AuthController@updateuser');
    Route::post('getusers', 'Auth\AuthController@getusers');
    Route::post('getusercargo', 'Auth\AuthController@getusercargo');
    Route::post('getbyemail', 'Auth\AuthController@getbyemail');
    Route::get('getalluser', 'Auth\AuthController@getalluser');
    Route::post('getnome', 'Auth\AuthController@getnome');

    //familia
    Route::post('familia', 'Auth\AuthController@familia');
    Route::post('getfamilia', 'Auth\AuthController@getfamilia');

    //senha
    Route::put('updatepassword', 'Auth\AuthController@updatepassword');
    Route::post('checkpassword', 'Auth\AuthController@checkpassword');
    
    
    //cargo
    Route::get('getcargos','Auth\AuthController@getcargos');
    Route::post('getidcargos','Auth\AuthController@getidcargos');

    //avental
    Route::get('getavental', 'Auth\AuthController@getavental');

    //precisa de autorizacao
    Route::middleware(['auth:api'])->group(function () {
        Route::get('logout', 'Auth\AuthController@logout');
        Route::get('user', 'Auth\AuthController@user');
    });
});

        
    
