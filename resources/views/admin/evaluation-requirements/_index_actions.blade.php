@if (Auth::user()->hasPermission('evaluation:evaluate'))
    @if ($notice->evaluationRequirements->isEmpty())
        <a href="{{ route('admin.evaluation-requirements.create', [$notice->id]) }}">{{ trans('actions.view') }}</a>
    @else
        <a href="{{ route('admin.evaluation-requirements.edit', [$notice->id]) }}">{{ trans('actions.view') }}</a>
    @endif
@endif
		