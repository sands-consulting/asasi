<div class="row">
	<div class="col-xs-12 col-md-2">
		<a href="{{ route('home') }}" class="prompt-box border border-bottom-grey-600">
			<div class="title text-right">{{ trans('dashboard.numbers.all') }}</div>
			<div class="number text-green-600">{{ App\Repositories\DashboardRepository::getAllNumber(Auth::user()) }}</div>
		</a>
	</div>

	<div class="col-xs-12 col-md-2">
		<a href="{{ route('dashboard.eligibles') }}" class="prompt-box border border-bottom-teal-400">
			<div class="title text-right">{{ trans('dashboard.numbers.eligibles') }}</div>
			<div class="number text-teal-400">{{ App\Repositories\DashboardRepository::getEligiblesNumber(Auth::user()) }}</div>
		</a>
	</div>

	<div class="col-xs-12 col-md-2">
		<a href="{{ route('dashboard.invitations') }}" class="prompt-box border border-bottom-info-400">
			<div class="title text-right">{{ trans('dashboard.numbers.invitations') }}</div>
			<div class="number text-info-400">{{ App\Repositories\DashboardRepository::getInvitationsNumber(Auth::user()) }}</div>
		</a>
	</div>

	<div class="col-xs-12 col-md-2">
		<a href="{{ route('dashboard.bookmarks') }}" class="prompt-box border border-bottom-blue-600">
			<div class="title text-right">{{ trans('dashboard.numbers.bookmarks') }}</div>
			<div class="number text-blue-600">{{ App\Repositories\DashboardRepository::getBookmarksNumber(Auth::user()) }}</div>
		</a>
	</div>

	<div class="col-xs-12 col-md-2">
		<a href="{{ route('dashboard.purchases') }}" class="prompt-box border border-bottom-indigo-700">
			<div class="title text-right">{{ trans('dashboard.numbers.purchases') }}</div>
			<div class="number text-indigo-700">{{ App\Repositories\DashboardRepository::getPurchasesNumber(Auth::user()) }}</div>
		</a>
	</div>

	<div class="col-xs-12 col-md-2">
		<a href="{{ route('dashboard.projects') }}" class="prompt-box border border-bottom-purple-400">
			<div class="title text-right">{{ trans('dashboard.numbers.projects') }}</div>
			<div class="number text-purple-400">{{ App\Repositories\DashboardRepository::getProjectsNumber(Auth::user()) }}</div>
		</a>
	</div>
</div>