<div role="tabpanel" class="tab-pane" id="tab-notice-events">
    <div class="panel panel-flat">
        <table class="table">
            <thead>
                <th width="5%">#</th>
                <th class="col-xs-1">{{ trans('notices.attributes.events.type') }}</th>
                <th class="col-xs-2">{{ trans('notices.attributes.events.schedule_at') }}</th>
                <th>{{ trans('notices.attributes.events.details') }}</th>
                <th>{{ trans('notices.attributes.events.required') }}</th>
            </thead>
            <tbody>
                @forelse ($notice->events as $event)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $event->type->name }}</td>
                    <td>{{ $event->schedule_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <strong>{{ $event->name }}</strong><br>
                        {!! nl2br($event->location) !!}
                    </td>
                    <td>{!! boolean_icon($event->required) !!}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">{{ trans('notices.views.admin.events.empty') }}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>