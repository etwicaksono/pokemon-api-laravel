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