@extends('layouts.window')

@section('page-title', trans('passwords.reset_password'))

@section('content')
<form class="form-horizontal panel" role="form" method="POST" action="{{ url('password/email') }}">
    <div class="panel-heading">
        {{ trans('auth.reset_password') }}
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

        <div class="form-group">
            <button type="submit" class="btn bg-blue-700 btn-block legitRipple">{{trans('passwords.buttons.send_password_link')}}</button>
        </div>

        <div class="text-center">
            <a href="{{ url('login') }}">{{trans('auth.login')}}</a> &bullet; <a href="{{ url('register') }}">{{trans('auth.register')}}</a>
        </div>
    </div>
</form>
@endsection