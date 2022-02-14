<?php
namespace App\Traits;

use App\Models\Day;
use App\Models\Month;
use App\Models\Year;
use Carbon\Carbon;

trait DateTimeScope{

    public function getActiveYear()
    {
        $year = Year::where('active_status',1)->first();
        if ($year) {
            return $year->title;
        }else{
            return Carbon::now()->format('Y');
        }
    }

    public function getYearById($id)
    {
        $year = Year::find($id);
        if ($year) {
            return $year->title;
        }else{
            return "Unknown";
        }
    }

    public function getMonthById($id)
    {
        $month = Month::find($id);
        if ($month) {
            return $month->title;
        }else{
            return "Unknown";
        }
    }

    public function getDayById($id)
    {
        $day = Day::find($id);
        if ($day) {
            return $day->title;
        }else{
            return "Unknown";
        }
    }

    public function activeYears()
    {
        $years = Year::Active()->orderBy('title')->pluck('title','id')->toArray();
        return array_prepend($years,'Select Year','0');
    }

    public function activeMonths()
    {
        $years = Month::Active()->pluck('title','id')->toArray();
        return array_prepend($years,'Select Year','0');
    }

    public function dateToWord($date)
    {
        $th = array(
            1 => "first", 2 => "second", 3 => "third", 4 => "fourth", 5 => "fifth", 6 => "sixth",
            7 => "seventh", 8 => "eighth", 9 => "nineth", 10 => "tenth", 11 => "eleventh", 12 => "twelfth", 13 => "thirteenth", 14 => "fourteenth", 15 => "fifteenth", 16 => "sixteenth", 17 => "seventeenth", 18 => "eighteenth", 19 => "nineteenth", 20 => "twentyth"
        );

        $ones = array(
            1 => "one", 2 => "two", 3 => "three", 4 => "four", 5 => "five", 6 => "six",
            7 => "seven", 8 => "eight", 9 => "nine", 10 => "ten", 11 => "eleven", 12 => "twelve", 13 => "thirteen",
            14 => "fourteen", 15 => "fifteen", 16 => "sixteen", 17 => "seventeen", 18 => "eighteen", 19 => "nineteen"
        );

        $tens = array(
            1 => "ten",2 => "twenty", 3 => "thirty", 4 => "forty", 5 => "fifty",
            6 => "sixty", 7 => "seventy", 8 => "eighty", 9 => "ninety"
        );

        $dateString = '25-04-2020';

        $day = date("j", strtotime($dateString));
        if ($day <= 20) $day = $th[$day];
        if($day > 20 ){
            $day = strval($day);
            $second = intval($day[1]);
            $str1 = $tens[intval($day[0])];
            $str2 = $th[intval($day[1])];
            $day = $str1." ".$str2;
        }

        $month = date("F", strtotime($dateString));
        $year = strval(date("Y", strtotime($dateString)));

        $first_half = intval($year[0].$year[1]);
        if($first_half < 20 ) $first_half = $ones[$first_half];
        if($first_half >= 20) {
            $first_half = $tens[$year[0]]." ".$ones[$year[1]];
        }

        $second_half = intval($year[2].$year[3]);
        if($second_half < 20 ) $second_half = $ones[$second_half];
        if($second_half >= 20) {
            $second_half = $tens[$year[2]]." ".$ones[$year[3]];
        }

        $years = $first_half." ".$second_half;
        return $day." ".strtolower($month)." ".$years;

    }


}