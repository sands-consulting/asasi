<ul class="icons-list">
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			<i class="icon-menu9"></i>
		</a>
		<ul class="dropdown-menu dropdown-menu-right">
			<li><a href="{{ route('admin.users.show', $user->id) }}">{{ trans('actions.view') }}</a></li>
			<li><a href="{{ route('admin.users.edit', $user->id) }}">{{ trans('actions.edit') }}</a></li>

			@if(Auth::user()->status == 'active')
			<li><a href="{{ route('admin.users.suspend', [$user->id, 'redirect_to' => route('admin.users.index')]) }}" data-method="PUT">{{ trans('actions.suspend') }}</a></li>
			@endif

			@if(Auth::user()->status != 'active')
			<li><a href="{{ route('admin.users.activate', [$user->id, 'redirect_to' => route('admin.users.index')]) }}" data-method="PUT">{{ trans('actions.activate') }}</a></li>
			@endif
		</ul>
	</li>
</ul>