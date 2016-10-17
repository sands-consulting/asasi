<ul class="icons-list">
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			<i class="icon-menu9"></i>
		</a>
		<ul class="dropdown-menu dropdown-menu-right">
			@if(Auth::user()->hasPermission('qualification-code:update'))
			<li><a href="{{ route('admin.qualification-codes.edit', $code->id) }}">{{ trans('actions.edit') }}</a></li>
			@endif

			@if(Auth::user()->hasPermission('qualification-code:delete'))
			<li><a href="{{ route('admin.qualification-codes.destroy', $code->id) }}" data-method="DELETE">{{ trans('actions.delete') }}</a></li>
			@endif
		</ul>
	</li>
</ul>