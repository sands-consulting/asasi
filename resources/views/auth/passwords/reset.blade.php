@extends('layouts.app')

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

                    {!! Former::vertical_open('password/reset')->method('POST') !!}
                        {!! Former::hidden('token')->value($token) !!}
                        {!! Former::text('email') !!}
                        {!! Former::password('password') !!}
                        {!! Former::password('password_confirmation') !!}

                        {!! Former::submit(trans('auth.attributes.reset_password'))->addClass('btn-primary') !!}
                    {!! Former::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
