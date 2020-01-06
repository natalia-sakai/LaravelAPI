<?php
namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\Financeiro as Authenticatable;
class Financeiro extends Authenticatable
{
    use HasApiTokens, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mes','valor','id_user','data_pag','ativo'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
}