@extends('layouts.public')

@section('header')
    <div class="page-title">
        <h4><i class="icon-home2 position-left"></i> <span class="text-semibold">{{ trans('home.views.index.title') }}</span></h4>

        {{-- <ul class="breadcrumb breadcrumb-caret position-right">
            <li><a href="{{ route('home.index') }}">Home</a></li>
            <li class="active">{{ trans('subscriptions.views.history.title') }}</li>
        </ul> --}}
    </div>

    {{-- <div class="heading-elements">
        <div class="heading-btn-group">
            <a href="{{ route('subscriptions.index') }}" class="btn btn-link btn-float has-text text-size-small legitRipple"><i class="icon-man text-indigo-400"></i> <span>Current</span></a>
            <a href="#" class="btn btn-link btn-float has-text text-size-small legitRipple"><i class="icon-calendar5 text-indigo-400"></i> <span>Packages</span></a>
        </div>
    </div>
    <a class="heading-elements-toggle"><i class="icon-more"></i></a> --}}
@stop

@section('content')
	<div class="row">
		<div class="col-sm-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h6 class="panel-title">Notice</h6>
					<div class="heading-elements panel-nav">
						<ul class="nav nav-tabs nav-tabs-bottom">
							@foreach($notice_types as $notice_type)
								@if($notice_type->type->id == $type)
								<li class="active">
								@else
								<li>
								@endif
									<a href="{{ route('home.index', ['type' => $notice_type->type->id]) }}" class="legitRipple" data-method="GET">
										<i class="icon-clipboard3 position-left"></i> {{ $notice_type->type->name }}
										<span class="legitRipple-ripple"></span>
									</a>
								</li>
							@endforeach
						</ul>
	            	</div>
					<a class="heading-elements-toggle"><i class="icon-more"></i></a>
				</div>
				
				<div class="panel-tab-content tab-content">
					<div class="tab-pane has-padding active" id="panel-tab-1">
						<div class="panel-body">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem, tempora rerum. Maxime voluptate rem temporibus itaque exercitationem totam impedit ex nisi dicta, deleniti voluptatum, quibusdam aliquam architecto! Recusandae, molestias, laboriosam.
						</div>
						<div class="table-responsive">
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>Organization</th>
										<th>Description</th>
										<th>Price</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									@foreach($notices as $notice)
									<tr>
										<td>{{ link_to_route('admin.notices.show', $notice->organization->name, $notice->id) }}</td>
										<td>
											<p>{{ $notice->name }}</p>
											<p><small>{{ str_limit($notice->description, 100) }}</small></p>
										</td>
										<td>{{ $notice->price }}</td>
										<td><a href="{{ route('carts.add', $notice->id) }}" class="btn btn-sm" data-method="POST">Add To Cart</a></td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>

					<div class="panel-footer panel-footer-condensed">
						<div class="heading-elements">
							<a href="#" class="heading-text text-default pull-right">Show more
							<i class="icon-arrow-right14 position-right"></i></a> 
						</div>
						<a class="heading-elements-toggle"><i class="icon-more"></i></a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="row">
				<div class="col-sm-12">
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title">{{ trans('home.views.index.panels.news.title') }}</h6>
						</div>

						<div class="panel-body">
							<div class="content-group-xs" id="bullets"></div>

							<ul class="media-list">
								<li class="media">
									<div class="media-body">
										Stats for July, 6: 1938 orders, $4220 revenue
										<div class="media-annotation">2 hours ago</div>
									</div>

									<div class="media-right">
										<a href="#"><i class="icon-arrow-right13"></i></a>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h6 class="panel-title">{{ trans('home.views.index.panels.vendors.title') }}</h6>
						</div>

						<div class="panel-body">
							@if (!empty($vendor))
								{!! Former::setOption('TwitterBootstrap3.labelWidths', array('large' => 5, 'small' => 5)) !!}
								{!! Former::open_horizontal()->method('POST') !!}
									{!! Former::populate($vendor) !!}
									
									{!! Former::text('name')
										->label('vendors.attributes.name')
										->readonly() !!}

									{!! Former::text('created_at')
										->label('vendors.attributes.created_at')
										->forceValue($vendor->created_at->format('d-m-Y'))
										->readonly() !!}

									{!! Former::text('status')
										->label('vendors.attributes.status')
										->forceValue(trans("statuses.$vendor->status"))
										->readonly() !!}
									@if ($vendor->status != 'approved')
										<div class="form-group">
											<div class="col-sm-12">
											@if ($vendor->status == 'draft')
												{!! link_to_route('vendors.edit', trans('vendors.buttons.edit-application'), $vendor->id, ['class' => 'btn btn-default btn-block']) !!}
												{!! Former::submit(trans('vendors.buttons.complete-application'))
													->addClass('btn-block bg-blue')
													->data_confirm(trans('app.confirmation'))
													->formaction(route('vendors.complete-application', $vendor->id)) !!}
											@endif
											@if($vendor->status == 'pending-approval')
												{!! Former::submit(trans('vendors.buttons.cancel-application'))
													->addClass('btn-block btn-danger')
													->data_confirm(trans('app.confirmation'))
													->formaction(route('vendors.cancel-application', $vendor->id)) !!}
											@endif
											@if($vendor->status == 'rejected')
												{!! Former::submit(trans('vendors.buttons.create-application'))
													->addClass('btn-block bg-blue')
													->data_confirm(trans('app.confirmation'))
													->formaction(route('vendors.create')) !!}
											@endif
											</div>
										</div>
									@endif
								@else
									{!! link_to_route('vendors.create', trans('vendors.buttons.create-application')) !!}
								@endif
							{!! Former::close() !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop
