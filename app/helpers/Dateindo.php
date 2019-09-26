<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class Dateindo
{
    public static function convertdate()
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('dmy');
        return $date;
    }
}
