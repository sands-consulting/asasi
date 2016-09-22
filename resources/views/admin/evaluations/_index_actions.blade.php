@if(Auth::user()->hasPermission('evaluation:evaluate'))
    <a href="{{ route('admin.evaluations.vendors', [$notice->type]) }}">{{ trans('actions.view') }}</a>
@endif
		