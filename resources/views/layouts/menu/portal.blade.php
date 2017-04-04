<div id="btn-portal" class="btn-group btn-group-justified" role="group">
	<a href="{{ route('root') }}" class="btn btn-link {{ is_path_active('/') }}">
		{{ trans('menu.portal.notices') }}
	</a>
	<a href="{{ route('submissions') }}" class="btn btn-link {{ is_path_active('submissions*') }}">
		{{ trans('menu.portal.submissions') }}
	</a>
	<a href="{{ route('awards') }}" class="btn btn-link {{ is_path_active('awards*') }}">
		{{ trans('menu.portal.awards') }}
	</a>
	<a href="{{ route('news.index') }}" class="btn btn-link {{ is_path_active('news*') }}">
		{{ trans('menu.portal.news') }}
	</a>
	<a href="{{ route('contact') }}" class="btn btn-link {{ is_path_active('contact*') }}">
		{{ trans('menu.portal.contact') }}
	</a>
</div>