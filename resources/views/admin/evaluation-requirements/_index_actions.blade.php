@if (Auth::user()->hasPermission('evaluation-requirement:edit'))
    <a href="{{ route('admin.evaluation-requirements.edit', [$notice->id]) }}">{{ trans('actions.view') }}</a>
@endif
		