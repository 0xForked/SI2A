<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Schema;

if (! function_exists('app_settings')) {
    function app_settings()
    {
        if (Schema::hasTable('settings')) {
            return to_assoc_array(Setting::all());;
        }

        return false;
    }
}
