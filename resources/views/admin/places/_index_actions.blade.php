<ul class="icons-list">
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			<i class="icon-menu9"></i>
		</a>
		<ul class="dropdown-menu dropdown-menu-right">
			@if(Auth::user()->hasPermission('place:show'))
			<li><a href="{{ route('admin.places.show', $place->id) }}">{{ trans('actions.view') }}</a></li>
			@endif

			@if(Auth::user()->hasPermission('place:update'))
			<li><a href="{{ route('admin.places.edit', $place->id) }}">{{ trans('actions.edit') }}</a></li>
			@endif

			@if($place->canActivate() && Auth::user()->hasPermission('place:activate'))
			<li><a href="{{ route('admin.places.activate', [$place->id, 'redirect_to' => route('admin.places.index')]) }}" data-method="PUT">{{ trans('actions.activate') }}</a></li>
			@endif

			@if($place->canDeactivate() && Auth::user()->hasPermission('place:deactivate'))
			<li><a href="{{ route('admin.places.deactivate', [$place->id, 'redirect_to' => route('admin.places.index')]) }}" data-method="PUT">{{ trans('actions.deactivate') }}</a></li>
			@endif
		</ul>
	</li>
</ul>