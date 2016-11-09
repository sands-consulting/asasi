@if(Auth::check())    
    @if(Auth::check() && Auth::user()->canAddNoticeToCart($bookmark->notice_id))
    <a href="{{ route('carts.add', $bookmark->notice_id) }}" class="btn btn-xs" data-method="POST"><i class="icon-cart"></i></a>
    @endif

    <a href="{{ route('bookmarks.remove', $bookmark->notice_id) }}" 
        class="btn btn-xs legitRipple" 
        data-method="POST"
        data-placement="left" 
        data-popup="tooltip" 
        title="Remove Bookmark">
        <i class="icon-bookmark2 text-danger"></i>
    </a>
@endif