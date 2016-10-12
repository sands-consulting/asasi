@if (Auth::user()->hasPermission('evaluation:evaluate'))
    <a href="{{ route('admin.evaluation-requirements.edit', [$notice->id]) }}">{{ trans('actions.view') }}</a>
@endif
		