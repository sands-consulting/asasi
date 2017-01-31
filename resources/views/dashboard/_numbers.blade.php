<div class="row">
	<div class="col-xs-12 col-md-2">
		<a href="{{ route('notices') }}" class="prompt-box border border-bottom-success-800 bg-success-600">
			<div class="title text-white text-right">{{ trans('dashboard.numbers.all') }}</div>
			<div class="number text-white">{{ App\Services\DashboardService::getAllNumber(Auth::user()) }}</div>
		</a>
	</div>

	<div class="col-xs-12 col-md-2">
		<a href="{{ route('vendors.eligibles', auth()->user()->vendor->slug) }}" class="prompt-box border border-bottom-teal-800 bg-teal-600">
			<div class="title text-white text-right">{{ trans('dashboard.numbers.eligibles') }}</div>
			<div class="number text-white">{{ App\Services\DashboardService::getEligiblesNumber(Auth::user()) }}</div>
		</a>
	</div>

	<div class="col-xs-12 col-md-2">
		<a href="{{ route('vendors.invitations') }}" class="prompt-box border border-bottom-info-800 bg-info-600">
			<div class="title text-white text-right">{{ trans('dashboard.numbers.invitations') }}</div>
			<div class="number text-white">{{ App\Services\DashboardService::getInvitationsNumber(Auth::user()) }}</div>
		</a>
	</div>

	<div class="col-xs-12 col-md-2">
		<a href="{{ route('vendors.bookmarks') }}" class="prompt-box border border-bottom-blue-800 bg-blue-600">
			<div class="title text-white text-right">{{ trans('dashboard.numbers.bookmarks') }}</div>
			<div class="number text-white">{{ App\Services\DashboardService::getBookmarksNumber(Auth::user()) }}</div>
		</a>
	</div>

	<div class="col-xs-12 col-md-2">
		<a href="{{ route('vendors.purchases') }}" class="prompt-box border border-bottom-indigo-800 bg-indigo-600">
			<div class="title text-white text-right">{{ trans('dashboard.numbers.purchases') }}</div>
			<div class="number text-white">{{ App\Services\DashboardService::getPurchasesNumber(Auth::user()) }}</div>
		</a>
	</div>

	<div class="col-xs-12 col-md-2">
		<a href="{{ route('vendors.projects') }}" class="prompt-box border border-bottom-violet-800 bg-violet-600">
			<div class="title text-white text-right">{{ trans('dashboard.numbers.projects') }}</div>
			<div class="number text-white">{{ App\Services\DashboardService::getProjectsNumber(Auth::user()) }}</div>
		</a>
	</div>
</div>