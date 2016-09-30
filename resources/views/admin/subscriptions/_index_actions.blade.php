<ul class="icons-list">
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			<i class="icon-menu9"></i>
		</a>
		<ul class="dropdown-menu dropdown-menu-right">
            @if(Auth::user()->hasPermission('subscription:show'))
            <li><a href="{{ route('admin.subscriptions.show', $subscription->id) }}">{{ trans('actions.view') }}</a></li>
            @endif

            @if(Auth::user()->hasPermission('subscription:update'))
            <li><a href="{{ route('admin.subscriptions.edit', $subscription->id) }}">{{ trans('actions.edit') }}</a></li>
            @endif

            @if($subscription->canActivate() && Auth::user()->hasPermission('subscription:activate'))
            <li><a href="{{ route('admin.subscriptions.activate', [$subscription->id, 'redirect_to' => route('admin.subscriptions.index')]) }}" data-method="PUT">{{ trans('actions.activate') }}</a></li>
            @endif

            @if($subscription->canDeactivate() && Auth::user()->hasPermission('subscription:deactivate'))
            <li><a href="{{ route('admin.subscriptions.deactivate', [$subscription->id, 'redirect_to' => route('admin.subscriptions.index')]) }}" data-method="PUT">{{ trans('actions.deactivate') }}</a></li>
            @endif
		</ul>
	</li>
</ul>