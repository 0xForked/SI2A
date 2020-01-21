<?php

use Illuminate\Support\Carbon;

if (!function_exists('clean_route_url')) {
    /**
     * Clean the url for the front end to display.
     *
     * @param string $link
     *
     * @return echo string
     */
    function clean_route_url($link)
    {
        $parsedUrl = parse_url($link);
        $routeUrl = '';
        if (isset($parsedUrl['path'])) {
            $routeUrl .= $parsedUrl['path'];
        }
        if (isset($parsedUrl['query'])) {
            $routeUrl .= '?'.$parsedUrl['query'];
        }
        echo $routeUrl;
    }
}

if (!function_exists('last_name')) {
    // use this function to get user last name from inline user full name
    function last_name($name)
    {
        $splitName = explode(' ', $name);
        $lastNameIndex = (count($splitName)-1);
        return !empty($splitName[$lastNameIndex]) ? $splitName[$lastNameIndex] : '';
    }
}

if (! function_exists('last_logged_in')) {
    // use this function to show currently logged in time
    // to user in local time and language
    function last_logged_in($date)
    {
        $diff = $date->diffForHumans();
        return str_replace(
            ["hour", "hours", "minute", "minutes", "seconds", "seconds", "ago"],
            ["Jam", "Jam", "Menit", "Menit", "Detik", "Detik", "lalu"],
            $diff
        );
    }
}


if (! function_exists('current_greeting')) {
    // use this function to return greeting message on user
    // in realtime with Carbon date and time library
    function current_greeting()
    {
        $hour = Carbon::now()->format('H');
        if ($hour < 11) return 'Selamat Pagi';
        if ($hour < 13) return 'Selamat Siang';
        if ($hour < 17) return 'Selamat Sore';
        return 'Selamat Malam';
    }
}


if (! function_exists('background_walk')) {
    // use this function to get/return image/background walk
    function background_walk()
    {
        $hour = Carbon::now()->format('H');
        if ($hour < 12) return 'gunung-tumpa.jpg';
        if ($hour < 17) return 'jembatan-soekarno.jpg';
        return 'malam-di-manado.jpg';
    }
}

if (! function_exists('transaction_type')) {
    function transaction_type($type)
    {
        if (isset($type)) {
            $data = ($type == 'purchase') ? 'Pembelian' : 'Penjualan';
            return ($data);
        }

        return;
    }
}


if (! function_exists('rupiah')) {
    function rupiah($price)
    {
        return number_format($price,0,',','.');
    }
}

