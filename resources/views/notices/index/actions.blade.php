<ul class="icons-list">
	<div class="btn-group">
		@can('bookmark', $notice)
		<a href="{{ route('notices.bookmark', $notice->id) }}" class="btn btn-xs legitRipple" data-method="POST">
	        <i class="icon-bookmark2"></i>
	    </a>
		@endcan

		<a href="{{ route('notices.show', $notice->id) }}" class="btn btn-xs legitRipple">
			<i class="icon-file-text2"></i>
		</a>

		@can('purchase', $notice)
		<a href="{{ route('cart.add', $notice->id) }}" class="btn btn-xs legitRipple" data-method="PUT">
	        <i class="icon-cart-add2"></i>
	    </a>
		@endcan
	</div>
</ul>
