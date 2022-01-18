<?php
if (!function_exists("isPrime")) {
    function isPrime($number)
    {
        if ($number == 1)
            return false;

        for ($i = 2; $i <= sqrt($number); $i++) {
            if ($number % $i == 0)
                return false;
        }
        return true;
    }
}

if (!function_exists("getFibonacci")) {
    function getFibonacci($number)
    {
        if ($number == 1) return 0;
        if ($number == 2 || $number == 3) return 1;
        $before = 0;
        $now = 1;

        $output = 0;
        for ($i = 0; $i < $number - 2; $i++) {
            $output = $before + $now;
            $before = $now;
            $now = $output;
        }

        return $output;
    }
}