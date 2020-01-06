<?php
namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\Ordem as Authenticatable;
class Ordem extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $table = 'ordem';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ordem','ativo','id_user'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
}