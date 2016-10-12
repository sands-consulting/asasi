@if(Auth::user()->hasPermission('evaluation:evaluate'))
    <a href="{{ route('admin.evaluations.evaluate', [$submission->notice_id, $submission->id]) }}">{{ trans('actions.evaluate') }}</a>
@endif
		