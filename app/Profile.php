<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'noktp', 'gender', 'alamat', 'provinsi', 'kota', 'kecamatan', 'desa'
    ];
}
