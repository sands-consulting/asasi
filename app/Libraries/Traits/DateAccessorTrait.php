<?php

namespace App\Libraries\Traits;

use App\Libraries\MyCarbon;

trait DateAccessorTrait
{
 
    public function freshTimestamp()
    {
        // was previously:  return new Carbon;
        return new MyCarbon;
    }
 
    protected function asDateTime($value)
    {
 
        if (is_numeric($value)) {
            
            // was previously:  return Carbon::createFromTimestamp($value);
            return MyCarbon::createFromTimestamp($value);
 
        } elseif (preg_match('/^(\d{4})-(\d{2})-(\d{2})$/', $value)) {
            
            // was previously:    return Carbon::createFromFormat('Y-m-d', $value)->startOfDay();
            return MyCarbon::createFromFormat('Y-m-d', $value)->startOfDay();
 
        } elseif (! $value instanceof DateTime) {
            
            $format = $this->getDateFormat();
            
            // was previously:  return Carbon::createFromFormat($format, $value);
            return MyCarbon::createFromFormat($format, $value);
            
        }
 
        // was previously:  return Carbon::instance($value);
        return MyCarbon::instance($value);
    }
 
}