<<<<<<< HEAD
@extends('layouts.window')

@section('page-title', trans('auth.login'))

@section('content')
<form class="form-horizontal panel" role="form" method="POST" action="{{ url('login') }}">
	<div class="panel-heading">
		{{ trans('auth.login') }}
	</div>

	<div class="panel-body">
		{!! csrf_field() !!}

		<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback has-feedback-left">
			<input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{ trans('auth.attributes.email') }}">
			<div class="form-control-feedback">
				<i class="icon-envelop5 text-muted"></i>
			</div>
			@if($errors->has('email'))<span class="help-block">{{ $errors->first('email') }}</span>@endif
		</div>

		<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback has-feedback-left">
			<input type="password" class="form-control" name="password" placeholder="{{ trans('auth.attributes.password') }}">
			<div class="form-control-feedback">
				<i class="icon-lock2 text-muted"></i>
			</div>
			@if($errors->has('password'))<span class="help-block">{{ $errors->first('password') }}</span>@endif
		</div>

		<div class="form-group">
			<button type="submit" class="btn bg-blue-700 btn-block legitRipple">{{trans('actions.login')}}</button>
		</div>

		<div class="text-center">
			<a href="{{ url('password/reset') }}">{{trans('auth.forgot_password')}}</a> &bullet; <a href="{{ url('register') }}">{{trans('auth.register')}}</a>
		</div>
	</div>
</form>
=======
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('auth.attributes.login') }}</div>
                <div class="panel-body">
                    {!! Former::vertical_open()->route('login')->method('POST') !!}

                        {!! Former::input('email') !!}
                        {!! Former::password('password') !!}
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}>
                                {{ trans('validation.attributes.remember_me') }}
                            </label>
                        </div>

                        {!! Former::submit(trans('auth.attributes.login'))->addClass('btn-primary') !!}
                        <a href="{{ url('password/reset') }}" class="btn btn-link">{{ trans('auth.attributes.forgot_password') }}</a>
                    {!! Former::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
>>>>>>> upstream/5.3
@endsection
