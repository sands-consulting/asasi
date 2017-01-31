@extends('layouts.portal')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h5 class="panel-title">
            {{ trans('profile.title') }}
        </h5>
    </div>
    <div class="panel-body">
        {!! Former::open(route('me'))->method('PUT') !!}
            {!! Former::populate(Auth::user()) !!}
            {!! Former::text('email')->label('profile.attributes.email')->disabled() !!}
            {!! Former::text('name')->label('profile.attributes.name')->required() !!}
            {!! Former::password('password')->label('profile.attributes.password') !!}
            {!! Former::password('password_confirmation')->label('profile.attributes.password_confirmation') !!}
            {!! Former::password('current_password')->label('profile.attributes.current_password') !!}
            <div class="form-group">
                <div class="col-md-offset-8 col-md-offset-4 col-xs-12">
                    {!! Former::submit(trans('actions.save'))->addClass('bg-blue')->data_confirm(trans('app.confirmation')) !!}
                </div>
            </div>  
        {!! Former::close() !!}
    </div>
</div>
@endsection
