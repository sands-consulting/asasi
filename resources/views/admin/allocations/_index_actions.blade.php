<ul class="icons-list">
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			<i class="icon-menu9"></i>
		</a>
		<ul class="dropdown-menu dropdown-menu-right">
			<li><a href="{{ route('admin.allocations.show', $allocation->id) }}">{{ trans('actions.view') }}</a></li>
			<li><a href="{{ route('admin.allocations.edit', $allocation->id) }}">{{ trans('actions.edit') }}</a></li>
		</ul>
	</li>
</ul>