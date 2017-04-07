<ul class="icons-list">
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			<i class="icon-menu9"></i>
		</a>
		<ul class="dropdown-menu dropdown-menu-right">
			@can('update', $type)
				<li><a href="{{ route('admin.qualification-types.edit', $type->id) }}">{{ trans('actions.edit') }}</a>
				</li>
			@endif

				@can('destroy', $type)
					<li><a href="{{ route('admin.qualification-types.destroy', $type->id) }}"
						   data-method="DELETE">{{ trans('actions.delete') }}</a></li>
			@endif
		</ul>
	</li>
</ul>