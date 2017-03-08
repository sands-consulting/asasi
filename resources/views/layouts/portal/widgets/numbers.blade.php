<div class="row">
	<div class="col-xs-12 col-md-2">
		<a href="{{ route('root') }}" class="prompt-box border border-bottom-success-800 bg-success-600">
			<div class="title text-white text-right">{{ trans('app.widgets.portal.numbers.all') }}</div>
			<div class="number text-white">{{ App\Services\PortalService::notices(Auth::user()) }}</div>
		</a>
	</div>

	<div class="col-xs-12 col-md-2">
		<a href="{{ route('vendors.eligibles', Auth::user()->vendor->id) }}" class="prompt-box border border-bottom-teal-800 bg-teal-600">
			<div class="title text-white text-right">{{ trans('app.widgets.portal.numbers.eligibles') }}</div>
			<div class="number text-white">{{ App\Services\PortalService::eligibles(Auth::user()) }}</div>
		</a>
	</div>

	<div class="col-xs-12 col-md-2">
		<a href="{{ route('vendors.invitations', Auth::user()->vendor->id) }}" class="prompt-box border border-bottom-info-800 bg-info-600">
			<div class="title text-white text-right">{{ trans('app.widgets.portal.numbers.invitations') }}</div>
			<div class="number text-white">{{ App\Services\PortalService::invitations(Auth::user()) }}</div>
		</a>
	</div>

	<div class="col-xs-12 col-md-2">
		<a href="{{ route('vendors.purchases', Auth::user()->vendor->id) }}" class="prompt-box border border-bottom-blue-800 bg-blue-600">
			<div class="title text-white text-right">{{ trans('app.widgets.portal.numbers.purchases') }}</div>
			<div class="number text-white">{{ App\Services\PortalService::purchases(Auth::user()) }}</div>
		</a>
	</div>

	<div class="col-xs-12 col-md-2">
		<a href="{{ route('vendors.submissions.index', Auth::user()->vendor->id) }}" class="prompt-box border border-bottom-indigo-800 bg-indigo-600">
			<div class="title text-white text-right">{{ trans('app.widgets.portal.numbers.submissions') }}</div>
			<div class="number text-white">{{ App\Services\PortalService::submissions(Auth::user()) }}</div>
		</a>
	</div>

	<div class="col-xs-12 col-md-2">
		<a href="{{ route('vendors.projects', Auth::user()->vendor->id) }}" class="prompt-box border border-bottom-violet-800 bg-violet-600">
			<div class="title text-white text-right">{{ trans('app.widgets.portal.numbers.projects') }}</div>
			<div class="number text-white">{{ App\Services\PortalService::projects(Auth::user()) }}</div>
		</a>
	</div>
</div>