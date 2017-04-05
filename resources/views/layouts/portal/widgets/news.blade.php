<div id="carousel-news" class="carousel slide prompt-box bg-white bg-white" data-ride="carousel">
	<ol class="carousel-indicators">
		@foreach(App\Services\PortalService::banners() as $news)
		<li data-target="#carousel-news" data-slide-to="{{ $loop->index }}" class="{{ $loop->index == 0 ? 'active' :'' }}"></li>
		@endforeach
	</ol>

	<h1 class="title">{{ trans('home.views.index.news.title') }}</h1>

	<div class="carousel-inner" role="listbox">
		@foreach(App\Services\PortalService::banners() as $news)
		<a href="{{ route('news.show', $news->slug) }}" class="item{{ $loop->index == 0 ? ' active': '' }}">
			<div class="title">{{ $news->title }}: {{ $news->summary }}</div>
			<div class="text-muted">{{ $news->created_at->format('d M Y') }} &bullet; {{ $news->category->name }}</div>
		</a>
		@endforeach
	</div>
</div>
