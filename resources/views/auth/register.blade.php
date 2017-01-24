@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('auth.attributes.register') }}</div>
                <div class="panel-body">
                    {!! Former::vertical_open()->route('register')->method('POST') !!}
                        {!! Former::text('name') !!}
                        {!! Former::email('email') !!}
                        {!! Former::password('password') !!}
                        {!! Former::password('password_confirmation') !!}
                        {!! Former::submit(trans('auth.attributes.register'))->addClass('btn-primary') !!}
                    {!! Former::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
