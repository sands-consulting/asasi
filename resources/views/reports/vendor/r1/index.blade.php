@extends('layouts.admin')

@section('header')
<div class="page-title">
    <h4>{{ trans('reports.title') }}</h4>
</div>
<div class="heading-elements">
    <div class="heading-btn-group">
        
    </div>
</div>
@endsection

@section('secondary-header')
<ul class="breadcrumb breadcrumb-caret">
    <li><a href="{{ route('admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
    <li class="active">{{ trans('reports.title') }}</li>
</ul>
@endsection

@section('content')
	<div class="row">
		<div class="col-sm-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">{{ trans('reports.vendor.r1.title') }}</h5>
                </div>

                <div class="panel-body">
                    {!! Former::open(route('reports.vendor.r1'))->target('_blank')->addClass('form-report') !!}
                        @include('reports.shortcut')
                        {!! Former::text('date_start')
                            ->label(trans('reports.labels.start_date'))
                            ->required()
                            ->addClass('daterange-single') !!}
                        {!! Former::text('date_end')
                            ->label(trans('reports.labels.end_date'))
                            ->required()
                            ->addClass('daterange-single') !!}
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2 col-sm-8 col-sm-offset-8">
                                <input type="submit" value="{{ trans('reports.labels.generate') }}" class="btn btn-success">
                            </div>
                        </div>
                    {!! Former::close() !!}
                </div>
            </div>
		</div>
		<div class="col-sm-4 col-sm-pull-8 col-xs-12">
		</div>
	</div>
</div>
@endsection

@section('scripts')
@endsection