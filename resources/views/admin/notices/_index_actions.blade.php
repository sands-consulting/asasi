<ul class="icons-list">
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			<i class="icon-menu9"></i>
		</a>
		<ul class="dropdown-menu dropdown-menu-right">
                  @if(Auth::user()->hasPermission('notice:show'))
                  <li><a href="{{ route('admin.notices.show', $notice->id) }}">{{ trans('actions.view') }}</a></li>
                  @endif

                  @if(Auth::user()->hasPermission('notice:update'))
                  <li><a href="{{ route('admin.notices.edit', $notice->id) }}">{{ trans('actions.edit') }}</a></li>
                  @endif

                  @if($notice->canPublish() && Auth::user()->hasPermission('notice:publish'))
                  <li><a href="{{ route('admin.notices.publish', [$notice->id, 'redirect_to' => route('admin.notices.index')]) }}" data-method="PUT">{{ trans('actions.publish') }}</a></li>
                  @endif

                  @if($notice->canUnpublish() && Auth::user()->hasPermission('notice:unpublish'))
                  <li><a href="{{ route('admin.notices.unpublish', [$notice->id, 'redirect_to' => route('admin.notices.index')]) }}" data-method="PUT">{{ trans('actions.unpublish') }}</a></li>
                  @endif
		</ul>
	</li>
</ul>