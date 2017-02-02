@extends('layouts.portal')

@section('page-title', trans('me.views.contact.title'))

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h5 class="panel-title">
            {{ trans('me.views.contact.title') }}
        </h5>
    </div>
    <div class="panel-body">
        {!! Former::vertical_open(route('contact'))->method('POST') !!}
            {!! Former::populate(Auth::user()) !!}
            {!! Former::text('name')->required() !!}
            {!! Former::text('email')->required() !!}
            {!! Former::text('title')->required() !!}
            {!! Former::textarea('message')->required()->rows(10) !!}

            {!! Former::submit(trans('actions.send'))->addClass('bg-blue')->data_confirm(trans('app.confirmation')) !!}
        {!! Former::close() !!}
    </div>
</div>
@endsection
