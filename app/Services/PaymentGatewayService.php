<?php

namespace App\Services;

use App\PaymentGateway;
use Sands\Asasi\Service\Exceptions\ServiceException;

class PaymentGatewayService extends BaseService 
{
	public static function settings(PaymentGateway $gateway, $settings)
    {
        $exists = [];

        foreach($settings as $data)
        {  
            $setting = $gateway->settings()->firstOrNew(['key' => $data['key']]);
            $setting->value = $data['value'];
            $setting->save();
            $exists[] = $setting->id;
        }

        $gateway->settings()->whereNotIn('id', $exists)->delete();
    }

    public static function organizations(PaymentGateway $gateway, $organizations)
    {
        $gateway->organizations()->sync($organizations);
    }
}
