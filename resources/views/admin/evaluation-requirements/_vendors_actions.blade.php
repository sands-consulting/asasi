@if(Auth::user()->hasPermission('evaluation:evaluate'))
    <a href="{{ route('admin.evaluations.evaluate', $submission->id) }}">{{ trans('actions.evaluate') }}</a>
@endif
		