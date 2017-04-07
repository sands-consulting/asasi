<ul class="icons-list">
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			<i class="icon-menu9"></i>
		</a>
		<ul class="dropdown-menu dropdown-menu-right">
			@can('update', $place)
			<li><a href="{{ route('admin.places.edit', $place->id) }}">{{ trans('actions.edit') }}</a></li>
			@endcan

			@can('destroy', $place)
				<li>
					<a href="{{ route('admin.places.destroy', [$place->id, 'redirect_to' => route('admin.places.index')]) }}"
					   data-method="DELETE">{{ trans('actions.delete') }}</a></li>
			@endcan
		</ul>
	</li>
</ul>