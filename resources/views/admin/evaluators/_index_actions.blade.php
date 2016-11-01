@if (Auth::user()->hasPermission('evaluation:evaluate'))
    @if ($evaluator->evaluator_status == 'active')
        <a href="{{ route('admin.evaluators.assign', [$evaluator->id, $evaluator->notice_id]) }}">{{ trans('actions.assign') }}</a>
    @else
        -
    @endif
@endif
		