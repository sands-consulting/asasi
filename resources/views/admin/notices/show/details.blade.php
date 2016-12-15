@extends('admin.notices.show')

@section('show')
@if($notice->description)
<div class="panel panel-flat">
    <div class="panel-body text-thin">{{ nl2br($notice->description) }}</div>
</div>
@endif

<div id="notice-group-rules" class="panel-group panel-group-control panel-group-control-right content-group-lg">
    <div class="panel panel-white">
        <div class="panel-heading">
            <h6 class="panel-title">
                <a class="collapsed" data-toggle="collapse" data-parent="#notice-group-rules" href="#notice-rules" aria-expanded="false" class="">{{ trans('notices.attributes.rules') }}</a>
            </h6>
        </div>
        <div id="notice-rules" class="panel-collapse collapse" aria-expanded="false">
            <div class="panel-body">
                {{ nl2br($notice->rules) }}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <ul class="list-group panel panel-flat">
            <li class="list-group-item">
                <h6 class="list-group-item-heading">
                    <i class="icon-cash3"></i> {{ trans('notices.attributes.price') }}
                </h6>
                <p class="list-group-item-text">
                    {{ \App\Setting::whereKey('currency')->first()->value }}
                    {{ $notice->price }}
                </p>
            </li>

            <li class="list-group-divider"></li>
            
            @if($notice->submission_address)
            <li class="list-group-item">
                <h6 class="list-group-item-heading">
                    <i class="icon-map5"></i> {{ trans('notices.attributes.submission_address') }}
                </h6>
                <p class="list-group-item-text">{{ nl2br($notice->submission_address )}}</p>
            </li>
            @endif

            <li class="list-group-item">
                <h6 class="list-group-item-heading">
                    <i class="icon-calendar3"></i> {{ trans('notices.attributes.submission_at') }}
                </h6>
                <p class="list-group-item-text">{{ $notice->submission_at->formatDateTimeFromSetting() }}</p>
            </li>
        </ul>
    </div>

    <div class="col-xs-12 col-md-6">
        <ul class="list-group panel panel-flat">
            @foreach(['published_at', 'purchased_at', 'expired_at'] as $key)
            <li class="list-group-item">
                <h6 class="list-group-item-heading">
                    <i class="icon-calendar3"></i> {{ trans('notices.attributes.'.$key) }}
                </h6>
                <p class="list-group-item-text">{{ $notice->{$key}->formatDateTimeFromSetting() }}</p>
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection