<ul class="icons-list">
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			<i class="icon-menu9"></i>
		</a>
		<ul class="dropdown-menu dropdown-menu-right">
            @if(Auth::user()->hasPermission('vendor:show'))
            <li><a href="{{ route('admin.vendors.show', $vendor->id) }}">{{ trans('actions.view') }}</a></li>
            @endif

            @if(Auth::user()->hasPermission('vendor:update'))
            <li><a href="{{ route('admin.vendors.edit', $vendor->id) }}">{{ trans('actions.edit') }}</a></li>
            @endif

            @if($vendor->canActivate() && Auth::user()->hasPermission('vendor:activate'))
            <li><a href="{{ route('admin.vendors.activate', [$vendor->id, 'redirect_to' => route('admin.vendors.index')]) }}" data-method="PUT">{{ trans('actions.activate') }}</a></li>
            @endif

            @if($vendor->canDeactivate() && Auth::user()->hasPermission('vendor:deactivate'))
            <li><a href="{{ route('admin.vendors.deactivate', [$vendor->id, 'redirect_to' => route('admin.vendors.index')]) }}" data-method="PUT">{{ trans('actions.deactivate') }}</a></li>
            @endif
		</ul>
	</li>
</ul>