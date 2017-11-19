<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }

    public function games()
    {
        return $this->belongsTo(Campaign::class)->withPivot('code');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
