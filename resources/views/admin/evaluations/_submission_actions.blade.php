@if(App\Submission::find($submission->submission_id)->scores()->exists())
    <a href="{{ route('admin.evaluations.edit', [$submission->notice_id, $submission->submission_id]) }}">{{ trans('actions.evaluate') }}</a>
@else
    <a href="{{ route('admin.evaluations.create', [$submission->notice_id, $submission->submission_id]) }}">{{ trans('actions.evaluate') }}</a>
@endif
		