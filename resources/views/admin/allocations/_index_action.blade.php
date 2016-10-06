<ul class="icons-list">
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			<i class="icon-menu9"></i>
		</a>
		<ul class="dropdown-menu dropdown-menu-right">
			<li><a href="{{ route('admin.news.edit', $news->id) }}">{{ trans('actions.edit') }}</a></li>

			@if($news->canPublish() && Auth::user()->hasPermission('news:publish'))
			<li><a href="{{ route('admin.news.publish', [$news->id, 'redirect_to' => route('admin.news.index')]) }}" data-method="PUT">{{ trans('actions.publish') }}</a></li>
			@endif

			@if($news->canUnpublish() && Auth::user()->hasPermission('news:unpublish'))
			<li><a href="{{ route('admin.news.unpublish', [$news->id, 'redirect_to' => route('admin.news.index')]) }}" data-method="PUT">{{ trans('actions.unpublish') }}</a></li>
			@endif
		</ul>
	</li>
</ul>