<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Tymon\JWTAuth\Contracts\JWTSubject;


class Member extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable,  Authorizable;
    protected $fillable = [
        'name', 'phone', 'password'
    ];

    protected $hidden = [
        'password'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function profile()
    {
        return $this->HasOne(Profile::class);
    }

    public function tiketdeposit()
    {
        return $this->hasMany(DepositTiket::class);
    }
}
