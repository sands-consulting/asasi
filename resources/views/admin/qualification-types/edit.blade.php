@extends('layouts.admin')

@section('page-title', implode(' | ', [
	$type->name,
	trans('qualification-types.title')
]))

@section('header')
<div class="page-title">
	<h4>
		{{ link_to_route('admin.qualification-types.index', trans('qualification-types.title')) }} /
		{{ $type->name }}
	</h4>
</div>
<div class="heading-elements">
	<div class="heading-btn-group">
		@if(Auth::user()->hasPermission('qualification-type:delete'))
			<a href="{{ route('admin.qualification-types.destroy', $type->id) }}" data-method="DELETE"
			   class="btn btn-link btn-float text-size-small has-text text-danger legitRipple">
			<i class="icon-trash"></i> <span>{{ trans('actions.delete') }}</span>
		</a>
		@endif

		<a href="{{ route('admin.qualification-types.index') }}"
		   class="btn btn-link btn-float text-size-small has-text legitRipple">
			<i class="icon-undo2"></i> <span>{{ trans('qualification-types.buttons.all') }}</span>
		</a>
	</div>
</div>
@endsection

@section('secondary-header')
<ul class="breadcrumb-elements">
	@if(Auth::user()->hasPermission('qualification-type:histories'))
	<li>
		<a href="{{ route('admin.qualification-types.histories', $type->id) }}" class="legitRipple">
			<i class="icon-database-time2"></i> {{ trans('user-histories.title') }}
		</a>
	</li>
	@endif

	@if(Auth::user()->hasPermission('qualification-type:revisions'))
	<li>
		<a href="{{ route('admin.qualification-types.revisions', $type->id) }}" class="legitRipple">
			<i class="icon-database-edit2"></i> {{ trans('revisions.title') }}
		</a>
	</li>
	@endif
</ul>
@endsection

@section('content')
<div class="panel panel-flat">
	<div class="panel-body">
		{!! Former::open(route('admin.qualification-types.update', $type->id))->method('PUT') !!}
			{!! Former::populate($type) !!}
		@include('admin.qualification-types.form')
		{!! Former::close() !!}
	</div>
</div>@endsection