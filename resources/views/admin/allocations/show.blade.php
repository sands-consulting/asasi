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
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-flat">
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-12">
							<div class="row">
								<div class="col-md-4 col-sm-12">
									<span class="text-muted">{{ $allocation->organization->name }}</span><br>
									<div class="text-left">{{ $allocation->name }}</div>
								</div>
								<div class="col-md-3 col-sm-12">
									<span class="text-muted">Year</span><br>
									<div class="text-left">2016</div>
								</div>
								<div class="col-md-3 col-sm-12">
									<span class="text-muted">{{ trans('allocations.attributes.created_at') }}</span><br>
									<div class="text-left">{{ $allocation->created_at }}</div>
								</div>
								<div class="col-md-2 col-sm-12 text-right">
									{{-- <label class="badge badge-warning text-thin"><span class="text-size-large">{{ $allocation->type->name }} </span></label> --}}
									<span class="label label-warning label-rounded text-thin">{{ $allocation->type->name }}</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="datatable-filter">
		<div class="row row-eq-height">
			<div class="col-sm-4">
				<a href="#" @click.prevent="handle_allocation($event)" data-filter="total" data-color="slate-300">
					<div class="panel panel-flat eq-element bg-slate-300">
						<div class="panel-body">
							<span class="text-size-large">{{ trans('allocations.views.show.panels.total') }}</span><br>
							<div class="text-center text-size-xlarge pt-10">RM {{ $allocation->value }}</div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-sm-4">
				<a href="#" @click.prevent="handle_allocation($event)" data-filter="allocated" data-color="teal-400">
					<div class="panel panel-flat eq-element border-bottom-teal-400 form-datatable-search">
						<div class="panel-body valign-middle">
							<span class="text-muted text-size-large">{{ trans('allocations.views.show.panels.allocated') }}</span><br>
							<div class="text-center text-size-xlarge text-teal-400 pt-10">RM {{ $allocation->projects()->sum('amount') }}</div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-sm-4">
				<a href="#" @click.prevent="handle_allocation($event)" data-filter="reserved" data-color="orange-600">
					<div class="panel panel-flat eq-element border-bottom-orange-600">
						<div class="panel-body valign-middle">
							<span class="text-muted text-size-large">{{ trans('allocations.views.show.panels.reserved') }}</span><br>
							<div class="text-center text-size-xlarge text-orange-600 pt-10">RM {{ $allocation->notices()->sum('amount') }}</div>
						</div>
					</div>	
				</a>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="panel">
					<div class="panel-heading" v-bind:class="panel_color">
						<h6 class="panel-title">{{ trans('allocations.views.show.panels.notices') }}</h6>
					</div>
					{{-- <div class="panel-body">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque animi esse temporibus aperiam, tempora veniam commodi voluptate eligendi exercitationem cum. Provident, inventore, doloribus. Dolor quia incidunt, dignissimos eos blanditiis vitae!
					</div> --}}
					{!! $dataTable->table() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection


@section('scripts')
{!! $dataTable->scripts() !!}
@endsection
