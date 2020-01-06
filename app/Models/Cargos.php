<?php
namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\Cargos as Authenticatable;
class Cargos extends Authenticatable
{
    use HasApiTokens, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cargo','value'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
}