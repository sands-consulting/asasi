@if(Auth::user()->hasPermission('evaluation:evaluate'))
    @if($submission->has('scores'))
    <a href="{{ route('admin.evaluations.edit', [$submission->notice_id, $submission->id]) }}">{{ trans('actions.evaluate') }}</a>
    @else
    <a href="{{ route('admin.evaluations.create', [$submission->notice_id, $submission->id]) }}">{{ trans('actions.evaluate') }}</a>
    @endif
@endif
		