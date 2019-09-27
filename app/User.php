<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use PHPZen\LaravelRbac\Traits\Rbac;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use Rbac;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'steamid', 'avatar', 'avatar_md', 'avatar_sm', 'url', 'realname', 'location', 'steam32', 'steam3'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
//    protected $casts = [
//        'email_verified_at' => 'datetime',
//    ];

    public function sendByUser()
    {
        return $this->hasMany('App\Report', 'sender_id', 'id');
    }

    public function perpetrateByUser()
    {
        return $this->hasMany('App\Report', 'perpetrator_id', 'id');
    }
}
