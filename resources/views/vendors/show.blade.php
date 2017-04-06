@extends('vendors.layout')

@section('inner')
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
@endsection