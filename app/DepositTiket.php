<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepositTiket extends Model
{
    protected $fillable = [
        'invoice', 'tipe', 'metode', 'notes', 'nominal', 'status'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
