<ul class="icons-list">
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			<i class="icon-menu9"></i>
		</a>
		<ul class="dropdown-menu dropdown-menu-right">
			@if(Auth::user()->hasPermission('qualification-code-type:update'))
			<li><a href="{{ route('admin.qualification-code-types.edit', $type->id) }}">{{ trans('actions.edit') }}</a></li>
			@endif

			@if(Auth::user()->hasPermission('qualification-code-type:delete'))
			<li><a href="{{ route('admin.qualification-code-types.destroy', $type->id) }}" data-method="DELETE">{{ trans('actions.delete') }}</a></li>
			@endif
		</ul>
	</li>
</ul>