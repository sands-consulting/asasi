@extends('layouts.portal')

@section('content')
@include('layouts.portal.widgets.wizard')

{!! Former::open_vertical_for_files(route('vendors.update', $vendor->id))->addClass('row vendor')->id('form-vendor')->method('PUT')->novalidate() !!}
	@include('admin.vendors.form')
{!! Former::close() !!}
@endsection
