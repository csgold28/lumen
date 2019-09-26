<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Komisi extends Model
{
    protected $fillable = ['komisi'];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
