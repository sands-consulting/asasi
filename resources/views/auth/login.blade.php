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
@endsection
