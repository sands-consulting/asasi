<div id="carousel-banners" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner" role="listbox">
    @foreach(App\Services\PortalService::banners() as $banner)
        <a href="{{ route('news.show', $banner->slug) }}" class="item{{ $loop->index == 0 ? ' active': '' }}">
            <div class="title">{{ $banner->title }}</div>
            <div class="summary">{{ $banner->summary }}</div>
        </a>
    @endforeach
    </div>

    <a class="left carousel-control" href="#carousel-banners" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">{{ trans('actions.previous') }}</span>
    </a>

    <a class="right carousel-control" href="#carousel-banners" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">{{ trans('actions.next') }}</span>
    </a>
</div>
