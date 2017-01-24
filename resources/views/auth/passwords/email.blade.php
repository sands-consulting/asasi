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
@endsection
