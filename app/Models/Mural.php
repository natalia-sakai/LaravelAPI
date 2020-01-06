<?php
namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\Mural as Authenticatable;
class Mural extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $table = 'mural';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'texto', 'id_users'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
}