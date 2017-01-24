@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('me.views.edit.title') }}</div>
                <div class="panel-body">
                    {!! Former::vertical_open()->route('me')->method('PUT') !!}
                        {!! Former::populate(Auth::user()) !!}
                        {!! Former::input('email') !!}
                        {!! Former::input('name') !!}
                        {!! Former::password('password') !!}
                        {!! Former::password('password_confirmation') !!}
                        {!! Former::password('current_password') !!}

                        {!! Former::submit(trans('app.actions.save'))->addClass('btn-primary') !!}
                    {!! Former::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
