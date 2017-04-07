@extends('layouts.portal')

@section('page-title', trans('contact.views.create.title'))

@section('ahead')
    @include('layouts.portal.aheads.public')
@endsection

@section('content')
@include('layouts.menu.portal')

<div class="panel panel-flat">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <h5>Hi there,</h5>
                <p class="text-justify">
                    Get stumble? you’ll find many ways to contact us right here. We’ll help you resolve your issues
                    quickly and easily, getting you back to more important things, like focusing on your business
                    activity.
                </p>
                <ul class="list list-square" style="list-style-type: square; padding-left: 25px">
                    <li>Operating Hours:</li>
                    <li>Monday-Friday: 8:00am – 4:00pm (GMT)</li>
                    <li>Saturday-Sunday: Off</li>
                </ul>
                <br>
                <p class="text-justify">
                    Please use the form below to contact us so we can route your case to the correct department.
                    For relevant technical support inquires please let us know if the problem you are experiencing is
                    limited to one system or if the problem appears on multiple systems. We strive to respond to all
                    inquiries within one working day.
                    Please pardon our delay if we do not respond as quickly as we would like.
                </p>
                <p class="text-justify">
                    Let us know how we can help you. Thank you
                </p>
            </div>
            <div class="col-md-6">
                <h5>Contact Us Form</h5>
                {!! Former::vertical_open(route('contact'))->method('POST')->addClass('panel-body') !!}
                {!! Former::populate(Auth::user()) !!}
                {!! Former::text('name')->required() !!}
                {!! Former::text('email')->required() !!}
                {!! Former::text('title')->required() !!}
                {!! Former::textarea('message')->required()->rows(10) !!}

                {!! Former::submit(trans('actions.send'))->addClass('bg-blue')->data_confirm(trans('app.confirmation')) !!}
                {!! Former::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
