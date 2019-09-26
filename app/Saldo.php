<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saldo extends Model
{
    protected $fillable = ['saldo'];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
