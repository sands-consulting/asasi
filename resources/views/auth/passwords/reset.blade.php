@extends('layouts.window')

@section('page-title', trans('passwords.reset_password'))

@section('content')
<form class="form-horizontal panel" role="form" method="POST" action="{{ url('password/reset') }}">
    <div class="panel-heading">
        {{ trans('auth.reset_password') }}
    </div>
    <div class="panel-body">
        {!! csrf_field() !!}
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback has-feedback-left">
            <input type="email" class="form-control" name="email" value="{{ $email or old('email') }}" placeholder="{{ trans('auth.attributes.email') }}">
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
            <button type="submit" class="btn bg-blue-700 btn-block legitRipple">{{trans('passwords.reset_password')}}</button>
        </div>
    </div>
</form>
@endsection
