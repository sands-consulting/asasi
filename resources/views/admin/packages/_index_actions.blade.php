<ul class="icons-list">
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			<i class="icon-menu9"></i>
		</a>
		<ul class="dropdown-menu dropdown-menu-right">

            @can('edit', $package)
            <li><a href="{{ route('admin.packages.edit', $package->id) }}">{{ trans('actions.edit') }}</a></li>
            @endcan

            @can('destroy', $package)
                <li>
                    <a href="{{ route('admin.packages.destroy', [$package->id, 'redirect_to' => route('admin.packages.index')]) }}"
                       data-method="DELETE">{{ trans('actions.delete') }}</a></li>
            @endcan
		</ul>
	</li>
</ul>