<ul class="icons-list">
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			<i class="icon-menu9"></i>
		</a>
		<ul class="dropdown-menu dropdown-menu-right">

                  @if(Auth::user()->hasPermission('notice-type:update'))
                  <li><a href="{{ route('admin.notice-types.edit', $noticeType->id) }}">{{ trans('actions.edit') }}</a></li>
                  @endif

                  @if(Auth::user()->hasPermission('notice-type:delete'))
                  <li><a href="{{ route('admin.notice-types.destroy', [$noticeType->id, 'redirect_to' => route('admin.notice-types.index')]) }}" data-method="DELETE">{{ trans('actions.delete') }}</a></li>
                  @endif
		</ul>
	</li>
</ul>