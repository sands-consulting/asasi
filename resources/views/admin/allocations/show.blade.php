@extends('layouts.admin')

@section('page-title', implode(' | ', [
	$allocation->name,
	trans('allocations.title')
]))

@section('header')
<div class="page-title">
	<h4>{{ link_to_route('admin.allocations.index', trans('allocations.title')) }} / <span class="text-semibold">{{ $allocation->name }}</span></h4>
</div>
<div class="heading-elements">
	<div class="heading-btn-group">
		@if(Auth::user()->hasPermission('allocation:update'))
		<a href="{{ route('admin.allocations.edit', $allocation->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
			<i class="icon-pencil5"></i> <span>{{ trans('allocations.buttons.edit') }}</span>
		</a>
		@endif

		@if(Auth::user()->id != $allocation->id && Auth::user()->hasPermission('allocation:delete'))
		<a href="{{ route('admin.allocations.destroy', $allocation->id) }}" data-method="DELETE" class="btn btn-link btn-float text-size-small has-text text-danger legitRipple">
			<i class="icon-trash"></i> <span>{{ trans('actions.delete') }}</span>
		</a>
		@endif
	</div>
</div>
@endsection

@section('secondary-header')
<ul class="breadcrumb-elements">
    @if(Auth::user()->hasPermission('allocation:logs'))
	<li>
		<a href="{{ route('admin.allocations.logs', $allocation->id) }}" class="legitRipple">
			<i class="icon-database-time2"></i> {{ trans('user-logs.title') }}
		</a>
	</li>
	@endif

	@if(Auth::user()->hasPermission('allocation:revisions'))
	<li>
		<a href="{{ route('admin.allocations.revisions', $allocation->id) }}" class="legitRipple">
			<i class="icon-database-edit2"></i> {{ trans('revisions.title') }}
		</a>
	</li>
	@endif
</ul>
@endsection

@section('content')
<div id="allocation-show">
	<div class="row row-eq-height form-datatable-search">
		<div class="col-sm-8">
			<div class="panel panel-flat">
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-9">
							<div class="row mb-20">
								<div class="col-sm-12">
									<span class="text-muted">{{ $allocation->organization->name }}</span><br>
									<div class="text-left">{{ $allocation->name }}</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<span class="text-muted">Year</span><br>
									<div class="text-left">2016</div>
								</div>
								<div class="col-sm-6">
									<span class="text-muted">{{ trans('allocations.attributes.created_at') }}</span><br>
									<div class="text-left">{{ $allocation->created_at }}</div>
								</div>
							</div>
						</div>
						<div class="col-sm-3 text-right">
							<label class="badge badge-warning"><span class="text-size-large">{{ $allocation->type->name }} </span></label>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="panel panel-flat bg-slate-300">
				<div class="panel-body">
					<span class="text-size-large">{{ trans('allocations.views.show.panels.total') }}</span><br>
					<div class="text-center text-size-xlarge">RM {{ $allocation->value }}</div>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<a href="#" v-on:click="perform_filter($event)" data-filter="usage">
				<div class="panel panel-flat border-bottom-orange-600">
					<div class="panel-body valign-middle">
						<span class="text-muted text-size-large">Usage</span><br>
						<div class="text-center text-size-xlarge text-orange-600">RM 42,000</div>
					</div>
				</div>	
			</a>
		</div>
		<div class="col-sm-4">
			<a href="#" v-on:click="perform_filter($event)" data-filter="allocated">
				<div class="panel panel-flat border-bottom-teal-400 form-datatable-search">
					<div class="panel-body valign-middle">
						<span class="text-muted text-size-large">Allocated</span><br>
						<div class="text-center text-size-xlarge text-teal-400">RM 8,000</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col-sm-4">
			<div class="panel panel-flat border-bottom-blue-300">
				<div class="panel-body valign-middle">
					<span class="text-muted text-size-large">Balance</span><br>
					<div class="text-center text-size-xlarge text-blue-300">RM 0</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-flat">
				{!! $dataTable->table() !!}
			</div>
		</div>
	</div>
</div>
@endsection


@section('scripts')
{!! $dataTable->scripts() !!}
@endsection
