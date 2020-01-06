<?php
namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\Avental as Authenticatable;
class Avental extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $table = 'avental';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'avental'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
}