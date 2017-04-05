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
		</ul>
	</li>
</ul>