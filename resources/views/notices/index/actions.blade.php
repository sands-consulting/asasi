<ul class="icons-list">
	@if(Auth::check())

	@can('purchase', $notice)
	<a href="{{ route('cart.add', $notice->notice_id) }}" class="btn btn-xs legitRipple" data-method="POST">
		<i class="icon-cart"></i>
	</a>
	@endcan

	@can('bookmark', $notice)
	<a href="{{ route('notice.bookmark', $notice->id) }}" class="btn btn-xs legitRipple" data-method="POST">
        <i class="icon-bookmark2"></i>
    </a>
	@endcan

    @endif

	<a href="{{ route('notices.show', $notice->id) }}">
		<i class="icon-file-text2"></i>
	</a>
</ul>
