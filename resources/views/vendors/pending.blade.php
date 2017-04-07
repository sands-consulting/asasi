@extends('layouts.portal')

@section('content')
@include('layouts.portal.widgets.wizard')

<div class="panel panel-white">
    <div class="panel-heading">
        <h4 class="panel-title pull-left">{{ trans('vendors.views.pending.title') }}</h4>
        {!! link_to_route('root', trans('vendors.views.pending.back'), [], ['class' => 'btn bg-blue-700 pull-right legitRipple']) !!}
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">
        {!! trans('vendors.views.pending.content', ['vendor-name' => $vendor->name]) !!}
    </div>
</div>
@stop
