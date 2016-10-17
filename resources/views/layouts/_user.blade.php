<li class="dropdown dropdown-user">
	<a class="dropdown-toggle" data-toggle="dropdown">
		{!! Gravatar::image(Auth::user()->email, Auth::user()->name, ['width' => 34, 'height' => 34]) !!}
		<span>{{ Auth::user()->name }}</span>
		<i class="caret"></i>
	</a>

	<ul class="dropdown-menu dropdown-menu-right">
		<li><a href="{{ route('profile') }}"><i class="icon-user"></i> {{ trans('menu.user.my_profile') }}</a></li>

		@if(session('original_user_id'))
		<li><a href="{{ route('profile.resume') }}" data-method="POST"><i class="icon-user-cancel"></i> {{ trans('menu.user.release_user') }}</a></li>
		@endif

		@if(Auth::user()->hasPermissions(['access:admin', 'access:report']))

		<li class="divider"></li>

		@if(Auth::user()->hasPermission('access:admin'))
		<li><a href="{{ route('admin') }}"><i class="icon-cog52"></i> {{ trans('menu.access.admin') }}</a></li>
		@endif

		@if(Auth::user()->hasPermission('access:report'))
		<li><a href="{{ route('admin') }}"><i class="icon-file-text"></i> {{ trans('menu.access.report') }}</a></li>
		@endif

		@endif

		<li class="divider"></li>

		<li><a href="{{ url('logout') }}"><i class="icon-switch2"></i> {{ trans('menu.user.sign_out') }}</a></li>
	</ul>
</li>