<div class="row">
	<div class="col-xs-12 col-md-2">
		<a href="{{ route('home') }}" class="prompt-box border border-bottom-success-800 bg-success-600">
			<div class="title text-white text-right">{{ trans('dashboard.numbers.all') }}</div>
			<div class="number text-white">{{ App\Repositories\DashboardRepository::getAllNumber(Auth::user()) }}</div>
		</a>
	</div>

	<div class="col-xs-12 col-md-2">
		<a href="{{ route('dashboard.eligibles') }}" class="prompt-box border border-bottom-teal-800 bg-teal-600">
			<div class="title text-white text-right">{{ trans('dashboard.numbers.eligibles') }}</div>
			<div class="number text-white">{{ App\Repositories\DashboardRepository::getEligiblesNumber(Auth::user()) }}</div>
		</a>
	</div>

	<div class="col-xs-12 col-md-2">
		<a href="{{ route('dashboard.invitations') }}" class="prompt-box border border-bottom-info-800 bg-info-600">
			<div class="title text-white text-right">{{ trans('dashboard.numbers.invitations') }}</div>
			<div class="number text-white">{{ App\Repositories\DashboardRepository::getInvitationsNumber(Auth::user()) }}</div>
		</a>
	</div>

	<div class="col-xs-12 col-md-2">
		<a href="{{ route('dashboard.bookmarks') }}" class="prompt-box border border-bottom-blue-800 bg-blue-600">
			<div class="title text-white text-right">{{ trans('dashboard.numbers.bookmarks') }}</div>
			<div class="number text-white">{{ App\Repositories\DashboardRepository::getBookmarksNumber(Auth::user()) }}</div>
		</a>
	</div>

	<div class="col-xs-12 col-md-2">
		<a href="{{ route('dashboard.purchases') }}" class="prompt-box border border-bottom-indigo-800 bg-indigo-600">
			<div class="title text-white text-right">{{ trans('dashboard.numbers.purchases') }}</div>
			<div class="number text-white">{{ App\Repositories\DashboardRepository::getPurchasesNumber(Auth::user()) }}</div>
		</a>
	</div>

	<div class="col-xs-12 col-md-2">
		<a href="{{ route('dashboard.projects') }}" class="prompt-box border border-bottom-violet-800 bg-violet-600">
			<div class="title text-white text-right">{{ trans('dashboard.numbers.projects') }}</div>
			<div class="number text-white">{{ App\Repositories\DashboardRepository::getProjectsNumber(Auth::user()) }}</div>
		</a>
	</div>
</div>