<div class="col-xs-12 col-md-9">
	<div id="carousel-banners" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carousel-banners" data-slide-to="0" class="active"></li>
			<li data-target="#carousel-banners" data-slide-to="1"></li>
			<li data-target="#carousel-banners" data-slide-to="2"></li>
		</ol>

		<div class="carousel-inner" role="listbox">
			<div class="item active">
				<img src="/assets/images/banner-01.jpg" alt="landing-page-image" class="img-responsive" alt="PROMPT">
			</div>
			<div class="item">
				<img src="/assets/images/banner-02.jpg" alt="landing-page-image" class="img-responsive" alt="PROMPT">
			</div>
			<div class="item">
				<img src="/assets/images/banner-03.jpg" alt="landing-page-image" class="img-responsive" alt="PROMPT">
			</div>
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

	{{-- <div id="carousel-news" class="carousel news slide" data-ride="carousel">
		<ol class="carousel-indicators">
			@foreach (App\News::published()->get() as $news)
			<li data-target="#carousel-news" data-slide-to="{{$news->id}}" class="active"></li>
			@endforeach
		</ol>

		<div class="carousel-title"><i class="icon icon-newspaper"></i> {{ trans('home.views.index.news.title') }}</div>

		<div class="carousel-inner" role="listbox" style="height: 200px">
			@forelse (App\News::published()->get() as $news)
				@php 
					if (!isset($active)) {
						$active = 'active';
					} else {
						$active = false;
					}
				@endphp
			<div class="item {{ $active }}">
				<span>{{ $news->title }}</span> 
				<p class="text-muted">{{ $news->content }}</p>
			</div>
			@empty
			<div class="item active">
				<span>No recent news published.</span>
				<p class="text-muted"></p>
			</div>
			@endforelse
		</div>

		<a class="left carousel-control" href="#carousel-news" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left text-slate-700" aria-hidden="true"></span>
			<span class="sr-only">{{ trans('actions.previous') }}</span>
		</a>

		<a class="right carousel-control" href="#carousel-news" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right text-slate-700" aria-hidden="true"></span>
			<span class="sr-only">{{ trans('actions.next') }}</span>
		</a>
	</div> --}}

	<div class="news mt-20">
	    <div class="panel panel">
	        <div class="panel-heading bg-blue-700"> <span class="glyphicon glyphicon-list-alt"></span><b>News</b></div>
	        <div class="panel-body">
	            <div class="row">
	                <div class="col-xs-12">
	                    <ul id="demo3">
	                        @forelse (App\News::published()->get() as $news)
	                        <li class="news-item">
								<span class="text-semibold"> {!! $news->title !!} </span> <br>
								<small>{!! str_limit(strip_tags($news->content,100)) !!}</small>
	                            <a href="#">Read more...</a>
	                        </li>
	                        @empty
	                        <li class="news-item">Not news published.
	                            {{-- <a href="#">Read more...</a> --}}
	                        </li>
	                        @endforelse
	                    </ul>
	                </div>
	            </div>
	        </div>
	        {{-- <div class="panel-footer bg-blue-700"></div> --}}
	    </div>
    </div>
</div>


