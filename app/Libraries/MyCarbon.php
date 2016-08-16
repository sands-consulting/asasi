<?php

namespace App\Libraries;
 
use Carbon\Carbon;
use App\Setting;
 
class MyCarbon extends Carbon
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

    public function getFromSetting()
    {
        $settingFormat = Setting::where('key', 'date_format')->first()->value;
        return $this->format($settingFormat);
    }
}