@extends('layouts.admin')

@section('page-title', trans('projects.title'))

@section('header')
<div class="page-title">
	<h4>{{ trans('projects.title') }}</h4>
</div>
<div class="heading-elements">
	<div class="heading-btn-group">
		<a href="{{ route('admin.projects.create') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
			<i class=" icon-plus-circle2"></i> <span>{{ trans('projects.buttons.create') }}</span>
		</a>
	</div>
</div>
@endsection

@section('secondary-header')
<ul class="breadcrumb breadcrumb-caret">
    <li><a href="{{ route('admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
    <li class="active">{{ trans('projects.views.index.title') }}</li>
</ul>
@endsection

@section('content')
<div class="panel panel-flat">
	{!! $dataTable->table() !!}
</div>
@endsection

@section('scripts')
{!! $dataTable->scripts() !!}
@endsection