<?php
namespace App\Models;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\Informativo as Authenticatable;
class Informativo extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $table = 'informativo';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'info','ativo','id_user','nivel'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
}