<div role="tabpanel" class="tab-pane" id="tab-notice-events">
    <div class="panel panel-flat">
        <table class="table">
            <thead>
                <th width="5%">#</th>
                <th>{{ trans('notices.views.admin.events.table.name') }}</th>
                <th>{{ trans('notices.views.admin.events.table.type') }}</th>
                <th>{{ trans('notices.views.admin.events.table.datetime') }}</th>
                <th>{{ trans('notices.views.admin.events.table.location') }}</th>
            </thead>
            <tbody>
                @if($notice->events()->count() > 0)
                    <?php $index = 1; ?>
                    @foreach ($notice->events as $event)
                        <tr>
                            <td>{{ $index }}</td>
                            <td>{{ $event->name }}</td>
                            <td>{{ $event->type->name }}</td>
                            <td>{{ $event->event_at }}</td>
                            <td>{{ $event->location }}</td>
                        </tr>
                        <?php $index++; ?>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-center">{{ trans('notices.views.admin.events.empty') }}</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>