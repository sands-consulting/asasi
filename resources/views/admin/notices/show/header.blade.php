<div class="panel panel-default">
    <div class="panel-body">
        <div class="pull-left text-thin"><strong>{{ $notice->organization->name }}</strong> {{ $notice->number }}</div>
        <div class="pull-right">
            <span class="label label-default">{{ $notice->type->name }}</span>

            @if(($invitation = $notice->settings()->whereKey('invitation')->first()) && $invitation->value == 1)
            <span class="label label-success">{{ trans('notices.views.admin.show.invitation') }}</span>
            @endif

             @if(($advertise = $notice->settings()->whereKey('advertise')->first()) && $advertise->value == 1)
            <span class="label label-danger">{{ trans('notices.views.admin.show.advertise') }}</span>
            @endif

            @include('admin.notices.index.status')
        </div>
        <div class="clearfix"></div>
        <h4 class="text-thin pull-left">{{ $notice->name }}</h4>
    </div>
</div>