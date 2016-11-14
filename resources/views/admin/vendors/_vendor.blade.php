<div class="prompt-box full">
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
		<li class="active"><a href="#">{{ trans('vendors.views._show.nav.details') }}</a></li>
		<li><a href="#">{{ trans('vendors.views._show.nav.qualification_codes') }}</a></li>
		<li><a href="#">{{ trans('vendors.views._show.nav.users') }}</a></li>
		<li><a href="#">{{ trans('vendors.views._show.nav.eligibles') }}</a></li>
		<li><a href="#">{{ trans('vendors.views._show.nav.invitations') }}</a></li>
		<li><a href="#">{{ trans('vendors.views._show.nav.projects') }}</a></li>
		<li><a href="#">{{ trans('vendors.views._show.nav.subscriptions') }}</a></li>
		<li><a href="#">{{ trans('vendors.views._show.nav.purchases') }}</a></li>
		<li><a href="#">{{ trans('vendors.views._show.nav.transactions') }}</a></li>
	</ul>
</div>