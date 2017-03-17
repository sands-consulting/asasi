<ul class="icons-list">
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			<i class="icon-menu9"></i>
		</a>
		<ul class="dropdown-menu dropdown-menu-right">
                  @can('show', $notice)
                  <li><a href="{{ route('admin.notices.show', $notice->id) }}">{{ trans('actions.view') }}</a></li>
                  @endcan

                  @can('edit', $notice)
                  <li><a href="{{ route('admin.notices.edit', $notice->id) }}">{{ trans('actions.edit') }}</a></li>
                  @endcan

                  @can('publish', $notice)
                  <li><a href="{{ route('admin.notices.publish', [$notice->id, 'redirect_to' => route('admin.notices.index')]) }}" data-method="PUT">{{ trans('actions.publish') }}</a></li>
                  @endcan

                  @can('unpublish', $notice)
                  <li><a href="{{ route('admin.notices.unpublish', [$notice->id, 'redirect_to' => route('admin.notices.index')]) }}" data-method="PUT">{{ trans('actions.unpublish') }}</a></li>
                  @endcan
		</ul>
	</li>
</ul>