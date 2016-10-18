@extends('layouts.public')

@section('ahead')
@include('home._landing')
@endsection

@section('content')
<div class="panel panel-notice">
    <div class="panel-heading">
        <h1 class="panel-title">{{ trans('home.views.index.notices.title') }}</h1>

        <div class="heading-elements">
            <ul class="list-inline heading-text">
                @foreach(\App\NoticeType::orderBy('name')->get() as $type)<li class="active"><a href="#"><i class="icon icon-file-text3"></i> {{ $type-> name }}</a>@endforeach
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