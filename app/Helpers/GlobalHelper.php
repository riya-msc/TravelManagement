<?php

namespace App\Helpers;

use App\Models\Setting;

class GlobalHelper
{
    public static function getSiteInfo()
    {
        $information = json_decode(Setting::first()->company_information);
        return $information;
    }

    public static function getServices()
    {
        $services = json_decode(Setting::first()->company_services);
        return $services;
    }

    public static function getAbout()
    {
        $about = json_decode(Setting::first()->company_about);
        return $about;
    }
}
