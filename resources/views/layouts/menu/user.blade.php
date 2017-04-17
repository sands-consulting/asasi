@if(Auth::user())

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
    		<a href="{{ route('docs') }}"><i class="icon-book"></i> {{ trans('menu.user.docs') }}</a>
		</li>


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

@else

<li>
    <a href="{{ route('register') }}">{{ trans('menu.user.register') }}</a>
</li>

<li class="dropdown dropdown-login">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ trans('menu.user.login') }}</a>
	<div class="dropdown-menu">
		<form class="form" role="form" method="POST" action="{{ url('login') }}">
			{!! csrf_field() !!}

			<div class="input-group has-feedback has-feedback-left">
				<input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{ trans('auth.attributes.email') }}">
				<div class="form-control-feedback">
					<i class="icon-envelop5 text-muted"></i>
				</div>
			</div>

			<div class="input-group has-feedback has-feedback-left">
				<input type="password" class="form-control" name="password" placeholder="{{ trans('auth.attributes.password') }}">
				<div class="form-control-feedback">
					<i class="icon-lock2 text-muted"></i>
				</div>
			</div>

			<button type="submit" class="btn bg-blue-700 btn-block legitRipple">{{trans('actions.login')}}</button>

			<div class="text-center">
				<a href="{{ url('password/reset') }}">{{trans('auth.forgot_password')}}</a>
			</div>
		</form>
	</div>
</li>

@endif