@extends('layouts.portal')

@section('content')
<div class="row mb-20">
    <div class="col-xs-12 col-md-2">
        <a href="{{ route('vendors.eligibles', Auth::user()->vendor->id) }}" class="btn btn-default btn-block btn-labeled btn-raised legitRipple">
            <b><i class="icon-arrow-left52"></i></b> {{ trans('vendors.views.show.back') }}
        </a>
    </div>
</div>

@include('admin.vendors.show.header')
    
<div class="row">
    <div class="col-xs-12 col-md-3">
        @include('admin.vendors.show.menu')
    </div>

    <div class="col-xs-12 col-md-9">
        <div class="tab-content">
            @include('admin.vendors.show.details')
            @include('admin.vendors.show.shareholders')
            @include('admin.vendors.show.qualifications')
            @include('admin.vendors.show.employees')
            @include('admin.vendors.show.accounts')
            @include('admin.vendors.show.files')
            @include('admin.vendors.show.users')
            @include('admin.vendors.show.subscriptions')
        </div>
    </div>
</div>
@endsection
