<div class="col-xs-12 col-md-3">
	<form class="form-horizontal form-login" role="form" method="POST" action="{{ url('login') }}">
		{!! csrf_field() !!}

		<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback has-feedback-left">
			<input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{ trans('auth.attributes.email') }}">
			<div class="form-control-feedback">
				<i class="icon-envelop5 text-muted"></i>
			</div>
			@if($errors->has('email'))<span class="help-block">{{ $errors->first('email') }}</span>@endif
		</div>

		<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback has-feedback-left">
			<input type="password" class="form-control bg-white" name="password" placeholder="{{ trans('auth.attributes.password') }}">
			<div class="form-control-feedback">
				<i class="icon-lock2 text-muted"></i>
			</div>
			@if($errors->has('password'))<span class="help-block">{{ $errors->first('password') }}</span>@endif
		</div>

		<div class="form-group">
			<input type="submit" class="btn bg-blue-700 btn-block legitRipple" value="{{ trans('actions.login') }}">
		</div>
	</form>

	<p class="text-center"><a href="{{ url('password/reset') }}" class="text-grey-600">{{ trans('auth.forgot_password') }}</a></p>

	<hr>

	<a href="{{ url('register') }}" class="btn border-grey-300 text-grey-300 btn-flat btn-block btn-register legitRipple">{{ trans('home.views.index.user.register_button') }}</a>

	<p class="text-center text-grey-600">{{ trans('home.views.index.user.register_text') }}</p>

	<hr>

	<p class="text-center"><a href="{{ url('/') }}" class="text-grey-600"><i class="icon icon-list3"></i> {{ trans('home.views.index.user.register_help') }}</a></p>

	<hr>
</div>
