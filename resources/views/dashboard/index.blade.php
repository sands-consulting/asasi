@extends('layouts.public')

@section('header')
    <div class="page-title">
        <h4><i class="icon-home2 position-left"></i> <span class="text-semibold">{{ trans('home.views.index.title') }}</span></h4>

        {{-- <ul class="breadcrumb breadcrumb-caret position-right">
            <li><a href="{{ route('home.index') }}">Home</a></li>
            <li class="active">{{ trans('subscriptions.views.history.title') }}</li>
        </ul> --}}
    </div>
	
	@if(Auth::user() && Auth::user()->hasPermission('access:vendor'))
    <div class="heading-elements">
        <div class="heading-btn-group">
			<a href="{{ route('subscriptions.current') }}" class="btn btn-link btn-float has-text text-size-small legitRipple"><i class="icon-stack text-indigo-400"></i> <span>My Package</span></a>
			<a href="{{ route('notices.my-notices') }}" class="btn btn-link btn-float has-text text-size-small legitRipple"><i class="icon-clipboard3 text-indigo-400"></i> <span>My Notices</span></a>
        </div>
    </div>
	@endif
@stop

@section('content')
	<div class="row">
		<div class="col-sm-6">
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h6 class="panel-title">{{ trans('home.views.index.panels.news.title') }}</h6>
				</div>

				<div class="panel-body" style="min-height: 210px">
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
						<li class="media">
							<div class="media-body">
								Stats for July, 6: 1938 orders, $4220 revenue
								<div class="media-annotation">2 hours ago</div>
							</div>

							<div class="media-right">
								<a href="#"><i class="icon-arrow-right13"></i></a>
							</div>
						</li>
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
		<div class="col-sm-6">
			<div class="row">
				<div class="col-sm-6">
					<div class="panel panel-flat border-bottom-success">
						<div class="panel-heading">
							<h6 class="panel-title">Bottom custom border</h6>
						</div>
						
						<div class="panel-body">
							Panel with bottom <code>success</code> border
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="panel panel-flat border-bottom-danger">
						<div class="panel-heading">
							<h6 class="panel-title">Bottom custom border</h6>
						</div>
						
						<div class="panel-body">
							Panel with bottom <code>success</code> border
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="panel panel-flat border-bottom-warning">
						<div class="panel-heading">
							<h6 class="panel-title">Bottom custom border</h6>
						</div>
						
						<div class="panel-body">
							Panel with bottom <code>success</code> border
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="panel panel-flat border-bottom-info">
						<div class="panel-heading">
							<h6 class="panel-title">Bottom custom border</h6>
						</div>
						
						<div class="panel-body">
							Panel with bottom <code>success</code> border
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
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
										<th>Qualification</th>
										<th>Expiry Date</th>
										<th>Price</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									@if(!$notices->isEmpty())
										@foreach($notices as $notice)
										<tr>
											<td>{{ $notice->organization->short_name }}</td>
											<td>
												<p>{{ link_to_route('admin.notices.show', $notice->name, $notice->id) }}</p>
												<p><small>{{ str_limit($notice->description, 100) }}</small></p>
											</td>
											<td></td>
											<td>{{ $notice->expired_at->getFromSetting() }}</td>
											<td>{{ $notice->price }}</td>
											<td>
												@if(Auth::user()->canBuy())
													<a href="{{ route('carts.add', $notice->id) }}" class="btn btn-sm" data-method="POST"><i class="icon-cart"></i> <br> Add To Cart</a>
												@else
													<i>Let vendor use cart and force to subscribe before paying</i>
												@endif
											</td>
										</tr>
										@endforeach
									@else
										<tr>
											<td colspan="4">Sorry, there is no notice with this type published yet.</td>
										</tr>
									@endif
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
	</div>
@stop
