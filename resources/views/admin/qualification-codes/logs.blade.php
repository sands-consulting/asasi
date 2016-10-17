@extends('layouts.admin')

@section('page-title', implode(' | ', [
	trans('user-logs.title'),
	$allocation->name,
	trans('qualification-codes.title')
]))

@section('header')
<div class="page-title">
	<h4>
		{{ link_to_route('admin.qualification-codes.index', trans('qualification-codes.title')) }} /
		{{ link_to_route('admin.qualification-codes.show', $allocation->name, $allocation->id) }} /
		<span class="text-semibold">{{ trans('user-logs.title') }}</span>
	</h4>
</div>
<div class="heading-elements">
	<div class="heading-btn-group">
		<a href="{{ route('admin.qualification-codes.show', $allocation->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
			<i class=" icon-undo2"></i> <span>{{ trans('actions.back') }}</span>
		</a>
	</div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
	{!! $dataTable->table() !!}
</div>
@endsection

@section('scripts')
{!! $dataTable->scripts() !!}
@endsection