@if (Auth::user()->hasPermission('evaluator:assign'))
    @if ($evaluator->evaluator_status == 'accepted')
        <a href="{{ route('admin.evaluators.assign', [$evaluator->id, $evaluator->notice_id]) }}">{{ trans('actions.assign') }}</a>
    @else
        -
    @endif
@endif
		