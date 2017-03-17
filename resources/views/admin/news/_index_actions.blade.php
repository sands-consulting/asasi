<ul class="icons-list">
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			<i class="icon-menu9"></i>
		</a>
		<ul class="dropdown-menu dropdown-menu-right">
			<li><a href="{{ route('admin.news.edit', $news->slug) }}">{{ trans('actions.edit') }}</a></li>

			@can('publish', $news)
			<li><a href="{{ route('admin.news.publish', [$news->slug, 'redirect_to' => route('admin.news.index')]) }}" data-method="PUT">{{ trans('actions.publish') }}</a></li>
			@endcan

			@can('unpublish', $news)
			<li><a href="{{ route('admin.news.unpublish', [$news->slug, 'redirect_to' => route('admin.news.index')]) }}" data-method="PUT">{{ trans('actions.unpublish') }}</a></li>
			@endcan
		</ul>
	</li>
</ul>