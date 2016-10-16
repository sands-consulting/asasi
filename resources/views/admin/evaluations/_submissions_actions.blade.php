@if(Auth::user()->hasPermission('evaluation:evaluate'))
    <a href="{{ route('admin.evaluations.create', [$submission->notice_id]) }}">{{ trans('actions.evaluate') }}</a>
@endif
		