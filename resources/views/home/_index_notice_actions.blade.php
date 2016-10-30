@if(Auth::check())    
    @if(Auth::check() && Auth::user()->canAddNoticeToCart($notice))
        <a href="{{ route('carts.add', $notice->id) }}" class="btn btn-xs" data-method="POST"><i class="icon-cart"></i></a>
    @endif

    @if(!in_array(Auth::user()->id, $notice->bookmarks->lists('user_id')->toArray()))
        <a href="{{ route('bookmarks.add', $notice->id) }}" class="btn btn-xs" data-method="POST"><i class="icon-bookmark3"></i></a>
    @else
        <i class="icon-bookmark2 text-danger"></i>
    @endif
@endif