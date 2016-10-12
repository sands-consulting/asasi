@if(Auth::user()->hasPermission('evaluation:evaluate'))
    <a href="{{ route('admin.evaluations.submissions', [$noticeEvaluator->id, 'type' => $noticeEvaluator->type]) }}">{{ trans('actions.view') }}</a>
@endif
		