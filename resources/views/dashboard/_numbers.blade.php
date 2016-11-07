<div class="row">
	<div class="col-xs-12 col-md-2">
		<a href="{{ route('home') }}" class="prompt-box border border-bottom-green-600">
			<div class="title text-right">{{ trans('dashboard.numbers.all') }}</div>
			<div class="number text-green-600">233</div>
		</a>
	</div>

	<div class="col-xs-12 col-md-2">
		<a href="{{ route('dashboard.eligibles') }}" class="prompt-box border border-bottom-teal-400">
			<div class="title text-right">{{ trans('dashboard.numbers.eligibles') }}</div>
			<div class="number text-teal-400">10</div>
		</a>
	</div>

	<div class="col-xs-12 col-md-2">
		<a href="{{ route('dashboard.invitations') }}" class="prompt-box border border-bottom-info-400">
			<div class="title text-right">{{ trans('dashboard.numbers.invitations') }}</div>
			<div class="number text-info-400">0</div>
		</a>
	</div>

	<div class="col-xs-12 col-md-2">
		<a href="{{ route('dashboard.bookmarks') }}" class="prompt-box border border-bottom-blue-600">
			<div class="title text-right">{{ trans('dashboard.numbers.bookmarks') }}</div>
			<div class="number text-blue-600">55</div>
		</a>
	</div>

	<div class="col-xs-12 col-md-2">
		<a href="{{ route('dashboard.purchases') }}" class="prompt-box border border-bottom-indigo-700">
			<div class="title text-right">{{ trans('dashboard.numbers.purchases') }}</div>
			<div class="number text-indigo-700">9</div>
		</a>
	</div>

	<div class="col-xs-12 col-md-2">
		<a href="{{ route('dashboard.projects') }}" class="prompt-box border border-bottom-purple-400">
			<div class="title text-right">{{ trans('dashboard.numbers.projects') }}</div>
			<div class="number text-purple-400">0</div>
		</a>
	</div>
</div>