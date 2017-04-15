<ul class="icons-list">
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			<i class="icon-menu9"></i>
		</a>
		<ul class="dropdown-menu dropdown-menu-right">
			@can('show', $transaction)
			<li><a href="{{ route('admin.transactions.show', $transaction->id) }}">{{ trans('actions.view') }}</a></li>
			@endcan
		</ul>
	</li>
</ul>