<?php

namespace App\Libraries;
 
use Carbon\Carbon as NesbotCarbon;
use App\Setting;
 
class Carbon extends NesbotCarbon
{
    // Example method getShort() which formats the object's
    // value with the defined short format string.
    public function getShort()
    {
        $shortFormat = 'jS M Y';
        return $this->format($shortFormat);
    }
 
    // Example method getLong() which formats the object's
    // value with the defined long format string.
    public function getLong()
    {
        $longFormat = 'jS /of M Y';
        return $this->format($longFormat);
    }

    public function formatDateFromSetting($format = 'd/m/Y')
    {
        $setting = Setting::where('key', 'date_format')->first();
        
        if ($setting) {
            $format = $setting->value;
        }

        return $this->format($format);
    }

    public function formatDateTimeFromSetting($format = 'd/m/Y H:i a')
    {
        $setting = Setting::where('key', 'datetime_format')->first();
        
        if ($setting) {
            $format = $setting->value;
        }

        return $this->format($format);
    }
}
