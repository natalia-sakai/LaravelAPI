<?php
namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\Reuniao as Authenticatable;
class Reuniao extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $table = 'reuniao';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'data','ativo'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
}
