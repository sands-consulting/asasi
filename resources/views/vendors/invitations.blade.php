@extends('layouts.portal')

@section('content')
@include('layouts.portal.aheads.vendor')

<div class="panel panel-notice">
    <div class="panel-heading bg-teal-600">
        <h1 class="panel-title">{{ trans('vendors.views.invitations.title') }}</h1>

        <div class="heading-elements">
            <ul class="list-inline heading-text">
                <li class="active"><a href="#"><i class="icon icon-file-text3"></i> {{ trans('app.all') }}</a></li>
                @foreach(\App\NoticeType::orderBy('name')->get() as $type)
                    <li><a href="#"><i class="icon icon-file-text3"></i> {{ $type-> name }}</a></li>
                @endforeach
            </ul>
        </div>
        <a class="heading-elements-toggle"><i class="icon-more"></i></a>
    </div>
    <div class="panel-body">
        {!! $dataTable->table() !!}
    </div>
</div>
@endsection

@section('scripts')
{!! $dataTable->scripts() !!}
@endsection