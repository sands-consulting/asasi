@extends('layouts.public')

@section('header')
    <div class="page-title">
        <h4><i class="icon-history position-left"></i> <span class="text-semibold">{{ trans('subscriptions.views.history.title') }}</span></h4>

        <ul class="breadcrumb breadcrumb-caret position-right">
            <li><a href="{{ route('home.index') }}">Home</a></li>
            <li class="active">{{ trans('subscriptions.views.history.title') }}</li>
        </ul>
    </div>

    <div class="heading-elements">
        <div class="heading-btn-group">
            <a href="{{ route('subscriptions.current') }}" class="btn btn-link btn-float has-text text-size-small legitRipple"><i class="icon-man text-indigo-400"></i> <span>Current</span></a>
            <a href="{{ route('subscriptions.index') }}" class="btn btn-link btn-float has-text text-size-small legitRipple"><i class="icon-stack3 text-indigo-400"></i> <span>Packages</span></a>
        </div>
    </div>
    <a class="heading-elements-toggle"><i class="icon-more"></i></a>
@stop

@section('content')
    <div class="row">
    	<div class="col-xs-12 col-sm-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h4 class="panel-title">{{ trans('subscriptions.views.history.list') }}</h4>
                </div>

                <div class="panel-body">
                    {!! $dataTable->table() !!}
                </div>
            </div>
    	</div>
    </div>
@stop

@section('scripts')
{!! $dataTable->scripts() !!}
@endsection
