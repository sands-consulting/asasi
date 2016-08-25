<ul class="icons-list">
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			<i class="icon-menu9"></i>
		</a>
		<ul class="dropdown-menu dropdown-menu-right">
                  @if(Auth::user()->hasPermission('notice-category:show'))
                  <li><a href="{{ route('admin.notice-categories.show', $noticeCategory->id) }}">{{ trans('actions.view') }}</a></li>
                  @endif

                  @if(Auth::user()->hasPermission('notice-category:update'))
                  <li><a href="{{ route('admin.notice-categories.edit', $noticeCategory->id) }}">{{ trans('actions.edit') }}</a></li>
                  @endif

                  @if($noticeCategory->canActivate() && Auth::user()->hasPermission('notice-category:activate'))
                  <li><a href="{{ route('admin.notice-categories.activate', [$noticeCategory->id, 'redirect_to' => route('admin.notice-categories.index')]) }}" data-method="PUT">{{ trans('actions.activate') }}</a></li>
                  @endif

                  @if($noticeCategory->canDeactivate() && Auth::user()->hasPermission('notice-category:deactivate'))
                  <li><a href="{{ route('admin.notice-categories.deactivate', [$noticeCategory->id, 'redirect_to' => route('admin.notice-categories.index')]) }}" data-method="PUT">{{ trans('actions.deactivate') }}</a></li>
                  @endif

                  @if(Auth::user()->hasPermission('notice-category:delete'))
                  <li><a href="{{ route('admin.notice-categories.destroy', [$noticeCategory->id, 'redirect_to' => route('admin.notice-categories.index')]) }}" data-method="DELETE">{{ trans('actions.delete') }}</a></li>
                  @endif
		</ul>
	</li>
</ul>