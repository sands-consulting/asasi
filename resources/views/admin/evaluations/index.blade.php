@extends('layouts.admin')

@section('page-title', trans('evaluations.title'))

@section('header')
<div class="page-title">
    <h4>{{ trans('evaluations.title') }}</h4>
</div>
<div class="heading-elements">
    
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">Notices</h6>
            </div>
            {!! $dataTable->table() !!}
        </div>
    </div>
</div>
@endsection

@section('scripts')
{!! $dataTable->scripts() !!}
@endsection