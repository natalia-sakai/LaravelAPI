<?php
namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\Familia as Authenticatable;
class Familia extends Authenticatable
{
    use HasApiTokens, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_users','data_nasc','grau'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
}