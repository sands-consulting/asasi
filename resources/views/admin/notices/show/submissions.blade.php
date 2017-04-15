<div role="tabpanel" class="tab-pane" id="tab-notice-submissions">
    <div class="panel panel-flat">
        <table class="table">
            <thead>
                <th width="5%">#</th>
                <th>{{ trans('notices.attributes.submissions.name') }}</th>
                <th>{{ trans('notices.attributes.submissions.number') }}</th>
                <th>{{ trans('notices.attributes.submissions.created_at') }}</th>
            </thead>
            <tbody>
                @forelse($notice->submissions()->whereStatus('submitted')->get() as $submission)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $submission->vendor->name }}</td>
                    <td>{{ $submission->number }}</td>
                    <td>{{ $submission->submitted_at->format('d/m/Y H:i:s') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" align="center">
                        {{ trans('notices.views.admin.show.submissions.empty') }}
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>