@if (Auth::user()->hasPermission('evaluation:evaluate'))
    @if ($evaluator->status == 'active')
        <a href="{{ route('admin.evaluators.assign', [$evaluator->notice_id, $evaluator->user_id]) }}">{{ trans('actions.assign') }}</a>
    @else
        -
    @endif
@endif
		