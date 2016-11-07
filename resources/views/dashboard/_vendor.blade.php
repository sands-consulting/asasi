<div class="prompt-box panel-vendor">
	<h1>{{ Auth::user()->vendor->name }}</h1>
	@if(Auth::user()->vendor->status == 'active')
	<span class="label label-success">
	@elseif(Auth::user()->vendor->status == 'pending')
	<span class="label label-default">
	@else
	<span class="label label-danger">
	@endif
	{{ trans('statuses.' . Auth::user()->vendor->status) }}
	</span>
	<p class="text-muted expiry">
		@if(Auth::user()->vendor->active_subscription)
		{{ trans('dashboard.vendor.expiry') }}: {{ Auth::user()->vendor->active_subscription->expired_at->format('d/m/Y') }}
		@else
		{{ trans('dashboard.vendor.no_subscription') }}
		@endif
	</p>
	@if(Auth::user()->vendor->expiring)<a href="#" class="text-danger-700 btn-renew">{{ trans('dashboard.vendor.renew') }}</a>@endif
	<div class="btn-group">
		<a href="{{ route('vendors.show', Auth::user()->vendor->id) }}"><i class="icon icon-file-text2"></i><br>{{ trans('dashboard.vendor.company_details') }}</a>
		<a href="#"><i class="icon icon-pen6"></i><br>{{ trans('dashboard.vendor.change_requests') }}</a>
		<a href="#"><i class="icon icon-folder-download"></i><br>{{ trans('dashboard.vendor.submissions') }}</a>
	</div>
</div>