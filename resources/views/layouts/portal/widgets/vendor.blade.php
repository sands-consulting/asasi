<div class="prompt-box bg-white panel-vendor">
	<h1>{{ Auth::user()->vendor->name }}</h1>
	@if(Auth::user()->vendor->status == 'active')
	<span class="label label-warning">
	@elseif(Auth::user()->vendor->status == 'pending')
	<span class="label label-warning">
	@elseif(Auth::user()->vendor->status == 'draft')
	<span class="label label-default">
	@else
	<span class="label label-danger">
	@endif
	{{ trans('statuses.' . Auth::user()->vendor->status) }}
	</span>
	<p class="text-muted expiry">
		@if(Auth::user()->vendor->active_subscription)
		{{ trans('app.widgets.portal.vendor.expiry') }}: {{ Auth::user()->vendor->active_subscription->expired_at->format('d/m/Y') }}
		@else
		{{ trans('app.widgets.portal.vendor.no_subscription') }}
		@endif
	</p>
	@if(Auth::user()->vendor->expiring)<a href="#" class="text-danger-700 btn-renew">{{ trans('app.widgets.portal.vendor.renew') }}</a>@endif
	<div class="btn-group">
		@if(in_array(Auth::user()->vendor->status, ['draft', 'rejected']))
		<a href="{{ route('vendors.edit', Auth::user()->vendor->id) }}"><i class="icon icon-pen6"></i><br>{{ trans('app.widgets.portal.vendor.continue_registration') }}</a>
		@else
		<a href="{{ route('vendors.show', Auth::user()->vendor->id) }}"><i class="icon icon-file-text2"></i><br>{{ trans('app.widgets.portal.vendor.company_details') }}</a>
		@if(Auth::user()->vendor->status != 'pending')
		<a href="#"><i class="icon icon-pen6"></i><br>{{ trans('app.widgets.portal.vendor.change_requests') }}</a>
		<a href="#"><i class="icon icon-bookmarks"></i><br>{{ trans('app.widgets.portal.vendor.bookmarks') }}</a>
		@endif
		@endif
	</div>
</div>