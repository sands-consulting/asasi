@if ($submission->status == 'completed' || $submission->status == 'submitted')
<a href="{{ route('admin.evaluations.edit', [$submission->notice_id, $submission->submission_id]) }}">{{ trans('actions.evaluate') }}</a>
@endif
