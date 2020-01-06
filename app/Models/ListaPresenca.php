<?php
namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\ListaPresenca as Authenticatable;
class ListaPresenca extends Authenticatable
{
    use HasApiTokens, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user','presenca','motivo', 'reuniao'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
}
