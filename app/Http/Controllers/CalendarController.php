<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendarController extends Controller
{
    //
    public static function dateFromHijri($date)
    {

        $date = strtotime($date);
        $m = date('m', $date);
        $d = date('d', $date);
        $y = date('Y', $date);

        $dd = (int)((11 * $y + 3) / 30) + 354 * $y + 30 * $m - (int)(($m - 1) / 2) + $d + 1948440 - 385;

        $date = strtotime(jdtogregorian($dd));

        $m = date('m', $date);
        $d = date('d', $date);
        $y = date('Y', $date);

        return $y.'-'.$m.'-'.$d;

    }

    public static function dateToHijri($date)
    {   

        $date = strtotime($date);
        $m = date('m', $date);
        $d = date('d', $date);
        $y = date('Y', $date);

        $jd = cal_to_jd(CAL_GREGORIAN, $m, $d, $y);

        $jd = $jd - 1948440 + 10632;
        $n  = (int)(($jd - 1) / 10631);
        $jd = $jd - 10631 * $n + 354;
        $j  = ((int)((10985 - $jd) / 5316)) *
            ((int)(50 * $jd / 17719)) +
            ((int)($jd / 5670)) *
            ((int)(43 * $jd / 15238));
        $jd = $jd - ((int)((30 - $j) / 15)) *
            ((int)((17719 * $j) / 50)) -
            ((int)($j / 16)) *
            ((int)((15238 * $j) / 43)) + 29;
        $m  = (int)(24 * $jd / 709);
        $d  = $jd - (int)(709 * $m / 24);
        $y  = 30*$n + $j - 30;

        return $y.'-'.$m.'-'.$d;
    }
}
