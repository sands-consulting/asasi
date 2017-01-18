<div class="prompt-box bg-white full">
	<div class="row">
		<div class="col-xs-12 col-md-4 panel-vendor">
			<h1>{{ $vendor->name }}</h1>
			@if($vendor->status == 'active')
			<span class="label label-success">
			@elseif($vendor->status == 'pending')
			<span class="label label-default">
			@else
			<span class="label label-danger">
			@endif
			{{ trans('statuses.' . $vendor->status) }}
			</span>
			
			<p class="text-muted expiry">
			@if($vendor->active_subscription)
			{{ trans('dashboard.vendor.expiry') }}: {{ $vendor->active_subscription->expired_at->format('d/m/Y') }}
			@else
			{{ trans('dashboard.vendor.no_subscription') }}
			@endif
			</p>
	
			@if($vendor->expiring)<a href="#" class="text-danger-700 btn-renew">{{ trans('dashboard.vendor.renew') }}</a>@endif
	
			<div class="btn-group">
				<a href="#"><i class="icon icon-pen6"></i><br>{{ trans('dashboard.vendor.change_requests') }}</a>
				<a href="#"><i class="icon icon-folder-download"></i><br>{{ trans('dashboard.vendor.submissions') }}</a>
			</div>
		</div>

		<div class="col-xs-12 col-md-4 panel-list">
			<ul>
				<li>
					<span class="header">{{ trans('vendors.attributes.contact_email') }}</span>
					{{ $vendor->contact_email }}
				</li>
				<li>
					<span class="header">{{ trans('vendors.attributes.contact_telephone') }}</span>
					{{ $vendor->contact_telephone }}
				</li>
				<li>
					<span class="header">{{ trans('vendors.attributes.contact_fax') }}</span>
					{{ $vendor->contact_fax }}
				</li>
			</ul>
		</div>

		<div class="col-xs-12 col-md-4 panel-list">
			<ul>
				<li>
					<span class="header">{{ trans('vendors.attributes.address') }}</span>
					{!! nl2br($vendor->address) !!}
				</li>
			</ul>
		</div>
	</div>
</div>

<div class="navbar navbar-default mb-15">
	<ul class="nav navbar-nav">
		<li class="{{ is_route_active('vendors.show') }}">
			<a href="{{ route('vendors.show', $vendor->id) }}">{{ trans('vendors.views._show.nav.details') }}</a>
		</li>
		<li class="{{ is_route_active('vendors.qualification-codes') }}">
			<a href="{{ route('vendors.qualification-codes', $vendor->id) }}">{{ trans('vendors.views._show.nav.qualification_codes') }}</a>
		</li>
		<li class="{{ is_route_active('vendors.users') }}">
			<a href="{{ route('vendors.users', $vendor->id) }}">{{ trans('vendors.views._show.nav.users') }}</a>
		</li>
		<li class="{{ is_route_active('vendors.subscriptions') }}">
			<a href="{{ route('vendors.subscriptions', $vendor->id) }}">{{ trans('vendors.views._show.nav.subscriptions') }}</a>
		</li>
	</ul>
</div>