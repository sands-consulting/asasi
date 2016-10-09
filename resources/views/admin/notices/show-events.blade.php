<fieldset class="mb-20">
    <legend class="text-semibold"> <i class="icon-calendar3"></i> Events</legend>
    <table class="table">
        <thead>
            <th width="5%">#</th>
            <th>Name</th>
            <th>Type</th>
            <th>Date Time</th>
            <th>location</th>
        </thead>
        <tbody>
            @if (!$notice->events->isEmpty())
                <?php $i = 1; ?>
                @foreach ($notice->events as $event)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $event->name }}</td>
                        <td>{{ $event->type->name }}</td>
                        <td>{{ $event->event_at }}</td>
                        <td>{{ $event->location }}</td>
                    </tr>
                    <?php $i++; ?>
                @endforeach
            @else
                <tr>
                    <td colspan="5">No event information found.</td>
                </tr>
            @endif
        </tbody>
    </table>
</fieldset>