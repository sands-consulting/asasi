<ul class="icons-list">
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			<i class="icon-menu9"></i>
		</a>
		<ul class="dropdown-menu dropdown-menu-right">
            @can('show', $subscription)
            <li><a href="{{ route('admin.subscriptions.show', $subscription->id) }}">{{ trans('actions.view') }}</a></li>
            @endcan

            @can('edit', $subscription)
            <li><a href="{{ route('admin.subscriptions.edit', $subscription->id) }}">{{ trans('actions.edit') }}</a></li>
            @endcan

            @can('activate', $subscription)
            <li><a href="{{ route('admin.subscriptions.activate', [$subscription->id, 'redirect_to' => route('admin.subscriptions.index')]) }}" data-method="PUT">{{ trans('actions.activate') }}</a></li>
            @endcan

            @can('cancel', $subscription)
            <li><a href="{{ route('admin.subscriptions.cancel', [$subscription->id, 'redirect_to' => route('admin.subscriptions.index')]) }}" data-method="PUT">{{ trans('actions.cancel') }}</a></li>
            @endcan
		</ul>
	</li>
</ul>