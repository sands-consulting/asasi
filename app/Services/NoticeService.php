<?php

namespace App\Services;

use App\Notice;
use App\NoticeEvent;
use App\NoticeQualificationCode;
use App\QualificationCode;
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

    public static function evaluationSettings(Notice $notice, $evaluations)
    {
        foreach($evaluations as $type => $inputs)
        {
            $data   = [];
            $typeId = $inputs['type_id'];
            unset($inputs['type_id']);

            if(isset($inputs['start_at']) && !empty($inputs['start_at']))
            {
                $data['start_at'] = $inputs['start_at'];
            }

            if(isset($inputs['end_at']) && !empty($inputs['end_at']))
            {
                $data['end_at'] = $inputs['end_at'];
            }

            $evaluation = $notice->evaluationSettings()->firstOrNew(['type_id' => $data['type_id']]);

            if(count($data) == 2)
            {
                $evaluation->fill($data);
                $evaluation->save();
            }
            else
            {
                if($evaluation->exists())
                {
                    $evaluation->delete();
                }
            }
        }
    }

    public static function events(Notice $notice, $inputs)
    {
        $exists = [];

        foreach($inputs as $data)
        {
            if(isset($data['id']) && !empty($data['id']))
            {
                $event = $notice->events()->find($data['id']);
            }

            if(!$event)
            {
                $event = new NoticeEvent;
                $event->notice()->associate($notice);
            }

            unset($data['id']);

            $event->fill($data);
            $event->save();

            $exists[] = $event->id;
        }

        $notice->events()->whereNotIn('id', $exists)->delete();
    }

    public static function allocations(Notice $notice, $inputs)
    {
        $allocations = [];

        foreach($inputs as $data)
        {
            $allocations[$data['id']] = [
                'amount' => $data['amount']
            ];
        }

        $notice->allocations()->sync($allocations);
    }

    public static function qualificationCodes($notice, $inputs)
    {
        $exists = [];

        foreach($inputs as $groupIndex => $groupInputs)
        {
            $group = $groupIndex + 1;
            $joinRule = isset($groupInputs['join_rule']) ? $groupInputs['join_rule'] : null;

            foreach ($groupInputs['codes'] as $codeIndex => $codeInputs) {
                $code = QualificationCode::find($codeInputs['code_id']);

                if(!$code)
                {
                    continue;
                }

                $sequence = $codeIndex + 1;
                $data = [
                    'group' => $group,
                    'sequence' => $sequence,
                    'code_id' => $code->id,
                    'type_id' => $code->type_id,
                    'group_rule' => $groupInputs['group_rule'],
                    'join_rule' => $joinRule
                ];

                if(isset($codeInputs['id']) && !empty($codeInputs['id']))
                {
                    $qualificationCode = $notice->qualificationCodes()->find($codeInputs['id']);
                }

                unset($codeInputs['id']);

                if(!isset($qualificationCode))
                {
                    $qualificationCode = new NoticeQualificationCode;
                    $qualificationCode->notice()->associate($notice);
                }

                $qualificationCode->fill($data);
                $qualificationCode->save();

                $exists[] = $qualificationCode->id;
                unset($qualificationCode);
            }
        }

        $notice->qualificationCodes()->whereNotIn('id', $exists)->delete();
    }
}
