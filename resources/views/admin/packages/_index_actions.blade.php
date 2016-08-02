<ul class="icons-list">
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			<i class="icon-menu9"></i>
		</a>
		<ul class="dropdown-menu dropdown-menu-right">
            @if(Auth::user()->hasPermission('package:show'))
            <li><a href="{{ route('admin.packages.show', $package->id) }}">{{ trans('actions.view') }}</a></li>
            @endif

            @if(Auth::user()->hasPermission('package:update'))
            <li><a href="{{ route('admin.packages.edit', $package->id) }}">{{ trans('actions.edit') }}</a></li>
            @endif

            @if($package->canActivate() && Auth::user()->hasPermission('package:activate'))
            <li><a href="{{ route('admin.packages.activate', [$package->id, 'redirect_to' => route('admin.packages.index')]) }}" data-method="PUT">{{ trans('actions.activate') }}</a></li>
            @endif

            @if($package->canDeactivate() && Auth::user()->hasPermission('package:deactivate'))
            <li><a href="{{ route('admin.packages.deactivate', [$package->id, 'redirect_to' => route('admin.packages.index')]) }}" data-method="PUT">{{ trans('actions.deactivate') }}</a></li>
            @endif
		</ul>
	</li>
</ul>