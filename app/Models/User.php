<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [ //especifica quais campos podem ser recebidos quando for usado o método de atribuição em massa
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [ //esconde os campos "protegidos"
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [ //conversão automatica
        'email_verified_at' => 'datetime',
    ];

    public function store()
    {
        //possui um
        return $this->hasOne(Store::class);
        /*
        Caso campo no banco seja diferente do nome da model, identificar o mesmo via parametro return
        Ex.: $this->hasOne(Store::class,'<nome_do_campo>');
        */
    }

    public function orders()
    {
        return $this->hasMany(UserOrder::class);
    }

    public function routeNotificationForVonage($notification)
    {
        return env('VONAGE_TO');
    }
}
