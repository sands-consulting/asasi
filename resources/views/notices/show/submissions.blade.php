<div role="tabpanel" class="panel panel-flat tab-pane" id="tab-notice-submissions">
    <table class="table">
        <thead>
            <th width="5%">#</th>
            <th>{{ trans('submissions.attributes.number') }}</th>
            <th>{{ trans('submissions.attributes.price') }}</th>
            <th>{{ trans('submissions.attributes.duration') }}</th>
        </thead>
        <tbody>
            @foreach($notice->submissions()->whereStatus('submitted')->orderBy('label', 'asc')->orderBy('number', 'asc')->get() as $submission)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $submission->label ?: $submission->number }}</td>
                <td>{{ setting('currency') }} {{ $submission->price }}</td>
                <td>{{ $submission->duration_in_text }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
