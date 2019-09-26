<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $fillable = ['poin'];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
