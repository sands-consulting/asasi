@extends('admin.notices.show')

@section('show')
<div class="panel panel-flat">
    <table class="table">
        <thead>
            <th width="5%">#</th>
            <th>{{ trans('notices.views.events.table.name') }}</th>
            <th>{{ trans('notices.views.events.table.type') }}</th>
            <th>{{ trans('notices.views.events.table.datetime') }}</th>
            <th>{{ trans('notices.views.events.table.location') }}</th>
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
                    <td colspan="5" class="text-center">{{ trans('notices.views.events.empty') }}</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection