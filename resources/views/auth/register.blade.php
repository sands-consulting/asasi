@extends('layouts.window')

@section('page-title', trans('auth.register'))

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-6 col-sm-offset-3">
        <div class="panel panel-body login-form">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('login') }}">
                {!! csrf_field() !!}

                <div class="text-center">
                    <h5 class="content-group">{{ strtoupper(trans('auth.register')) }}</h5>
                </div>

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} has-feedback has-feedback-left">
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="{{ trans('auth.name') }}">
                    <div class="form-control-feedback">
                        <i class="icon-user text-muted"></i>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} has-feedback has-feedback-left">
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{ trans('auth.email') }}">
                    <div class="form-control-feedback">
                        <i class="icon-envelop5 text-muted"></i>
                    </div>
                </div>

                <div class="form-group has-feedback has-feedback-left">
                    <input type="password" class="form-control" name="password" placeholder="{{ trans('auth.password') }}">
                    <div class="form-control-feedback">
                        <i class="icon-lock2 text-muted"></i>
                    </div>
                </div>

                <div class="form-group has-feedback has-feedback-left">
                    <input type="password" class="form-control" name="password" placeholder="{{ trans('auth.confirm_password') }}">
                    <div class="form-control-feedback">
                        <i class="icon-lock2 text-muted"></i>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn bg-blue-700 btn-block legitRipple">{{trans('auth.register_button')}}</button>
                </div>

                <div class="text-center">
                    <a href="{{ url('/login') }}">{{trans('auth.login')}}</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
