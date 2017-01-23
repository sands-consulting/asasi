<?php

namespace App\Traits;

use App\Libraries\Carbon;

trait DateAccessorTrait
{
 
    public function freshTimestamp()
    {
        // was previously:  return new Carbon;
        return new Carbon;
    }
 
    protected function asDateTime($value)
    {
 
        if (is_numeric($value)) {
            
            // was previously:  return Carbon::createFromTimestamp($value);
            return Carbon::createFromTimestamp($value);
 
        } elseif (preg_match('/^(\d{4})-(\d{2})-(\d{2})$/', $value)) {
            
            // was previously:    return Carbon::createFromFormat('Y-m-d', $value)->startOfDay();
            return Carbon::createFromFormat('Y-m-d', $value)->startOfDay();
 
        } elseif (! $value instanceof DateTime) {
            
            $format = $this->getDateFormat();
            
            // was previously:  return Carbon::createFromFormat($format, $value);
            return Carbon::createFromFormat($format, $value);
            
        }
 
        // was previously:  return Carbon::instance($value);
        return Carbon::instance($value);
    }
 
}