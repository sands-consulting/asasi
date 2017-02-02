@extends('layouts.portal')

@section('page-title', trans('me.views.edit.title'))

@section('content')
<div class="row">
    <div class="col-xs-12 col-md-3">
        <div class="thumbnail">
            <div class="thumb thumb-rounded thumb-slide">
                <img src="{{ Gravatar::src(Auth::user()->email, 100) }}" class="img-circle" alt="{{ Auth::user()->name }}">
            </div>
    
            <div class="caption text-center">
                <h6 class="text-semibold">
                    {{ Auth::user()->name }}<br>
                    <small>{{ Auth::user()->email }}</small>
                </h6>

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

    <div class="col-xs-12 col-md-9">
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
                        <div class="col-md-offset-8 col-md-offset-4 col-xs-12">
                            {!! Former::submit(trans('actions.save'))->addClass('bg-blue')->data_confirm(trans('app.confirmation')) !!}
                        </div>
                    </div>  
                {!! Former::close() !!}
            </div>
        </div>
@endsection
