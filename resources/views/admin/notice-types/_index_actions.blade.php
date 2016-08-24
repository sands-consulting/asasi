<ul class="icons-list">
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			<i class="icon-menu9"></i>
		</a>
		<ul class="dropdown-menu dropdown-menu-right">
                  @if(Auth::user()->hasPermission('notice-type:show'))
                  <li><a href="{{ route('admin.notice-types.show', $noticeType->id) }}">{{ trans('actions.view') }}</a></li>
                  @endif

                  @if(Auth::user()->hasPermission('notice-type:update'))
                  <li><a href="{{ route('admin.notice-types.edit', $noticeType->id) }}">{{ trans('actions.edit') }}</a></li>
                  @endif

                  @if($noticeType->canActivate() && Auth::user()->hasPermission('notice-type:activate'))
                  <li><a href="{{ route('admin.notice-types.activate', [$noticeType->id, 'redirect_to' => route('admin.notice-types.index')]) }}" data-method="PUT">{{ trans('actions.activate') }}</a></li>
                  @endif

                  @if($noticeType->canDeactivate() && Auth::user()->hasPermission('notice-type:deactivate'))
                  <li><a href="{{ route('admin.notice-types.deactivate', [$noticeType->id, 'redirect_to' => route('admin.notice-types.index')]) }}" data-method="PUT">{{ trans('actions.deactivate') }}</a></li>
                  @endif
		</ul>
	</li>
</ul>