<?php

namespace App\Services;

use App\Setting;

class SettingService extends BaseService 
{
	public static function sync($inputs=[], $context=null)
	{
		foreach($inputs as $key => $value)
		{
			if($context)
			{
				$setting = $context->settings()->firstOrCreate(['key' => $key]);
			}
			else
			{
				$setting = Setting::firstOrCreate(['key' => $key]);
			}

			$setting->value = $value;
			$setting->save();
		}
	}
}
