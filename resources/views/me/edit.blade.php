@extends('layouts.app')

@section('page-title', trans('me.views.edit.title'))

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-4">
            <div class="panel panel-default thumbnail">
                <br>
                <img src="{{ Gravatar::src(Auth::user()->email, 100) }}" class="img-circle" alt="{{ Auth::user()->name }}">

                <div class="caption text-center">
                    <h4>
                        {{ Auth::user()->name }}<br>
                        <small>{{ Auth::user()->email }}</small>
                    </h4>

                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <dt>{{ trans('me.attributes.created_at') }}</dt>
                            <dd>{{ Auth::user()->created_at->formatDateTimeFromSetting() }}</dd>
                        </div>

                        <div class="col-xs-12 col-md-6">
                            <dt>{{ trans('me.attributes.updated_at') }}</dt>
                            <dd>{{ Auth::user()->updated_at->formatDateTimeFromSetting() }}</dd>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="panel-title">
                        {{ trans('me.views.edit.title') }}
                    </h5>
                </div>
                <div class="panel-body">
                    {!! Former::open(route('me'))->method('PUT') !!}
                        {!! Former::populate(Auth::user()) !!}
                        {!! Former::text('name')->required() !!}
                        {!! Former::password('password') !!}
                        {!! Former::password('password_confirmation') !!}
                        {!! Former::password('current_password') !!}

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4 col-xs-12">
                                {!! Former::submit(trans('actions.save'))->addClass('btn-primary')->data_confirm(trans('app.confirmation')) !!}
                            </div>
                        </div>  
                    {!! Former::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
