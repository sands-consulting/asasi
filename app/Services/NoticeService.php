<?php

namespace App\Services;

use App\Notice;
use Sands\Asasi\Service\Exceptions\ServiceException;

class NoticeService extends BaseService 
{
	public static function publish(Notice $notice)
    {
        if($notice->status == 'published')
        {
            throw new ServiceException('Publishing ' . Notice::class, $notice);
        }

        $notice->status = 'published';
        $notice->save();
    }

    public static function unpublish(Notice $notice)
    {
        if($notice->status == 'not-publish')
        {
            throw new ServiceException('Unpublishing ' . Notice::class, $notice);
        }

        $notice->status = 'not-publish';
        $notice->save();
    }

    public static function cancel(Notice $notice)
    {
        if($notice->status == 'cancelled')
        {
            throw new ServiceException('Cancelling ' . Notice::class, $notice);
        }

        $notice->status = 'cancelled';
        $notice->save();
    }

    public static function settings(Notice $notice, $settings)
    {
        foreach($settings as $key => $value)
        {
            $setting = $notice->settings()->firstOrNew(['key' => $key]);
            $setting->value = $value;
            $setting->save();
        }
    }

    public static function evaluations(Notice $notice, $evaluations)
    {
        foreach($evaluations as $typeId => $data)
        {
            $evaluation = $notice->evaluationSettings()->firstOrNew(['type_id' => $typeId]);
            $evaluation->fill($data);
            $evaluation->save();
        }
    }
}
