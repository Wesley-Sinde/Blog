<?php
namespace App\Traits;

use Illuminate\Http\Request;

trait CommonScope{

    public function getGreeting()
    {
        /* This sets the $time variable to the current hour in the 24 hour clock format */
        $time = date("H");
        /* Set the $timezone variable to become the current timezone */
        $timezone = date("Asia/Katmandu");
        /* If the time is less than 1200 hours, show good morning */
        if ($time < "12") {
            $greeting = "Good morning";
        } else
            /* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */
            if ($time >= "12" && $time < "17") {
                $greeting = "Good afternoon";
            } else
                /* Should the time be between or equal to 1700 and 1900 hours, show good evening */
                if ($time >= "17" && $time < "19") {
                    $greeting = "Good evening";
                } else
                    /* Finally, show good night if the time is greater than or equal to 1900 hours */
                    if ($time >= "19") {
                        $greeting = "Good night";
                    }


                    return $greeting ;

    }

    public function randomNum($prefix,$size) {
        /*$alpha_key = '';
        $keys = range('A', 'Z');

        for ($i = 0; $i < 2; $i++) {
            $alpha_key .= $keys[array_rand($keys)];
        }

        $length = $size - 2;

        $key = '';
        $keys = range(0, 9);

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $prefix . $key. $alpha_key;*/

        /*$alpha_key = '';
        $keys = range('A', 'Z');

        for ($i = 0; $i < 2; $i++) {
            $alpha_key .= $keys[array_rand($keys)];
        }

        $length = $size - 2;*/

        $key = '';
        $keys = range(0, 9);

        for ($i = 0; $i < $size; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $prefix . $key;
    }

}