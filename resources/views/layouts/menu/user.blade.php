<li class="dropdown dropdown-user">
	<a class="dropdown-toggle" data-toggle="dropdown">
		{!! Gravatar::image(Auth::user()->email, Auth::user()->name, ['width' => 34, 'height' => 34]) !!}
		<span>{{ Auth::user()->name }}</span>
		<i class="caret"></i>
	</a>

	<ul class="dropdown-menu dropdown-menu-right">
		<li><a href="{{ route('me') }}"><i class="icon-user"></i> {{ trans('menu.user.my_profile') }}</a></li>

		@can('resume', Auth::user())
		<li><a href="{{ route('me.resume') }}" data-method="POST"><i class="icon-user-cancel"></i> {{ trans('menu.user.release_user') }}</a></li>
		@endcan

		<li>
			<a href="{{ url('/logout') }}"
				onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
				<i class="icon-switch2"></i> {{ trans('menu.user.sign_out') }}
			</a>

			<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
				{{ csrf_field() }}
			</form>
		</li>
	</ul>
</li>