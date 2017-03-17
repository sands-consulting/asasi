<div role="tabpanel" class="tab-pane" id="tab-notice-events">
    <div class="panel panel-flat">
        <table class="table">
            <thead>
                <th width="5%">#</th>
                <th class="col-xs-1">{{ trans('notices.views.admin.events.table.type') }}</th>
                <th class="col-xs-2">{{ trans('notices.views.admin.events.table.datetime') }}</th>
                <th>{{ trans('notices.views.admin.events.table.details') }}</th>
            </thead>
            <tbody>
                @forelse ($notice->events as $event)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $event->type->name }}</td>
                    <td>{{ $event->event_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <strong>{{ $event->name }}</strong><br>
                        {!! nl2br($event->location) !!}
                    </td>
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