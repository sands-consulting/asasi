<ul class="icons-list">
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			<i class="icon-menu9"></i>
		</a>
		<ul class="dropdown-menu dropdown-menu-right">
                  <li>
                        <a href="{{ route('notices.submission', $notice->notice_id) }}">
                            <i class="icon-compose"></i> {{ trans('notices.buttons.submission') }}
                        </a>
                  </li>
		</ul>
	</li>
</ul>