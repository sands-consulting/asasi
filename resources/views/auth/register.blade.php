@extends('layouts.window')

@section('page-title', trans('auth.register'))

@section('content')
<form class="form-horizontal panel" role="form" method="POST" action="{{ url('register') }}">
    <div class="panel-heading">
        {{ trans('auth.register') }}
    </div>

    <div class="panel-body">
        {!! csrf_field() !!}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} has-feedback has-feedback-left">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="{{ trans('auth.attributes.name') }}">
            <div class="form-control-feedback">
                <i class="icon-user text-muted"></i>
            </div>
            @if($errors->has('name'))<span class="help-block">{{ $errors->first('name') }}</span>@endif
        </div>

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

        <div class="form-group has-feedback has-feedback-left">
            <input type="password" class="form-control" name="password_confirmation" placeholder="{{ trans('auth.attributes.password_confirmation') }}">
            <div class="form-control-feedback">
                <i class="icon-lock2 text-muted"></i>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn bg-blue-700 btn-block legitRipple">{{trans('actions.register')}}</button>
        </div>

        <div class="text-center">
            <a href="{{ url('password/reset') }}">{{trans('auth.forgot_password')}}</a> &bullet; <a href="{{ url('login') }}">{{trans('auth.login')}}</a>
        </div>
    </div>
</form>
@endsection
