<ul class="icons-list">
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			<i class="icon-menu9"></i>
		</a>
		<ul class="dropdown-menu dropdown-menu-right">
			<li><a href="{{ route('admin.organizations.show', $organization->id) }}">{{ trans('actions.view') }}</a></li>
			<li><a href="{{ route('admin.organizations.edit', $organization->id) }}">{{ trans('actions.edit') }}</a></li>

			@if($organization->canActivate() && Auth::user()->hasPermission('organization:activate'))
			<li><a href="{{ route('admin.organizations.activate', [$organization->id, 'redirect_to' => route('admin.organizations.index')]) }}" data-method="PUT">{{ trans('actions.suspend') }}</a></li>
			@endif

			@if($organization->canDeactivate() && Auth::user()->hasPermission('organization:deactivate'))
			<li><a href="{{ route('admin.organizations.deactivate', [$organization->id, 'redirect_to' => route('admin.organizations.index')]) }}" data-method="PUT">{{ trans('actions.deactivate') }}</a></li>
			@endif

			@if($organization->canSuspend() && Auth::user()->hasPermission('organization:suspend'))
			<li><a href="{{ route('admin.organizations.suspend', [$organization->id, 'redirect_to' => route('admin.organizations.index')]) }}" data-method="PUT">{{ trans('actions.suspend') }}</a></li>
			@endif
		</ul>
	</li>
</ul>