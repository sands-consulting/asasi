@extends('layouts.portal')

@section('page-title', trans('contact.views.create.title'))

@section('ahead')
    @include('layouts.portal.aheads.public')
@endsection

@section('content')
@include('layouts.menu.portal')

<div class="panel panel-flat">
    {!! Former::vertical_open(route('contact'))->method('POST')->addClass('panel-body') !!}
        {!! Former::populate(Auth::user()) !!}
        {!! Former::text('name')->required() !!}
        {!! Former::text('email')->required() !!}
        {!! Former::text('title')->required() !!}
        {!! Former::textarea('message')->required()->rows(10) !!}

        {!! Former::submit(trans('actions.send'))->addClass('bg-blue')->data_confirm(trans('app.confirmation')) !!}
    {!! Former::close() !!}
</div>
@endsection
