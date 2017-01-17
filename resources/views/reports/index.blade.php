@extends('layouts.admin')

@section('header')
<div class="page-title">
    <h4>{{ trans('reports.views.index.title') }}</h4>
</div>
<div class="heading-elements">
    <div class="heading-btn-group">
        
    </div>
</div>
@endsection

@section('secondary-header')
<ul class="breadcrumb breadcrumb-caret">
    <li><a href="{{ route('admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
    <li class="active">{{ trans('reports.views.index.title') }}</li>
</ul>
@endsection

@section('content')
<div class="row is-flex">
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5 class="panel-title">Vendor Reports</h5>
            </div>
            <div class="panel-body">
                <ul class="list">
                    <li>
                        <a href="{{ route('reports.vendor.r1') }}">Vendor Status</a>
                    </li>
                    <li>
                        <a href="#">Vendor Status</a>
                    </li>
                    <li>
                        <a href="#">Vendor Status</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5 class="panel-title">Notice Reports</h5>
            </div>
            <div class="panel-body">
                <ul class="list">
                    <li>Report 1</li>
                    <li>Report 2</li>
                    <li>Report 3</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
@endsection