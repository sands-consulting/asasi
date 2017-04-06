<ul class="icons-list">
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			<i class="icon-menu9"></i>
		</a>
		<ul class="dropdown-menu dropdown-menu-right">
            @can('update', $noticeCategory)
                <li>
                    <a href="{{ route('admin.notice-categories.edit', $noticeCategory->id) }}">{{ trans('actions.edit') }}</a>
                </li>
            @endcan

            @can('destroy', $noticeCategory)
                <li>
                    <a href="{{ route('admin.notice-categories.destroy', [$noticeCategory->id, 'redirect_to' => route('admin.notice-categories.index')]) }}"
                       data-method="DELETE">{{ trans('actions.delete') }}</a></li>
            @endcan
		</ul>
	</li>
</ul>