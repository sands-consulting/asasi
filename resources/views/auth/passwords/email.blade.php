<<<<<<< HEAD
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
=======
@extends('layouts.app')

<!-- Main Content -->
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('auth.attributes.reset_password') }}</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    {!! Former::vertical_open('password/email')->method('POST') !!}
                        {!! Former::text('email') !!}
                        {!! Former::submit(trans('auth.attributes.send_password_reset_link'))->addClass('btn-primary') !!}
                    {!! Former::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
>>>>>>> upstream/5.3
@endsection
