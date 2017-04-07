<ul class="icons-list">
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			<i class="icon-menu9"></i>
		</a>
		<ul class="dropdown-menu dropdown-menu-right">
			<li><a href="{{ route('admin.organizations.edit', $organization->id) }}">{{ trans('actions.edit') }}</a></li>

			@can('suspend', $organization)
			<li><a href="{{ route('admin.organizations.suspend', [$organization->id, 'redirect_to' => route('admin.organizations.index')]) }}" data-method="PUT">{{ trans('actions.suspend') }}</a></li>
			@endcan

			@can('destroy', $organization)
				<li>
					<a href="{{ route('admin.organizations.destroy', [$organization->id, 'redirect_to' => route('admin.organizations.index')]) }}"
					   data-method="DELETE">{{ trans('actions.delete') }}</a></li>
			@endcan
		</ul>
	</li>
</ul>