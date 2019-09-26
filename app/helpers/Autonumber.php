<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

use App\Helpers\Dateindo;

class Autonumber
{
    public static function autonumber()
    {
        $q = DB::table('deposit_tikets')->select(DB::raw('MAX(RIGHT(' . "id" . ',5)) as kd_max'));
        $prx = Dateindo::convertdate();
        if ($q->count() > 0) {
            foreach ($q->get() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = $prx . sprintf("%06s", $tmp);
            }
        } else {
            $kd = $prx . "000001";
        }

        return $kd;
    }
}
