<div class="col-xs-12 col-md-9">
	<div id="carousel-banners" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carousel-banners" data-slide-to="0" class="active"></li>
			<li data-target="#carousel-banners" data-slide-to="1"></li>
			<li data-target="#carousel-banners" data-slide-to="2"></li>
		</ol>

		<div class="carousel-inner" role="listbox">
			<div class="item active">
				<img src="/assets/images/landing-picture-1.png" alt="landing-page-image" class="img-responsive" alt="PROMPT">
			</div>
			<div class="item">
				<img src="/assets/images/landing-picture-1.png" alt="landing-page-image" class="img-responsive" alt="PROMPT">
			</div>
			<div class="item">
				<img src="/assets/images/landing-picture-1.png" alt="landing-page-image" class="img-responsive" alt="PROMPT">
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

	<div id="carousel-news" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carousel-news" data-slide-to="0" class="active"></li>
			<li data-target="#carousel-news" data-slide-to="1"></li>
			<li data-target="#carousel-news" data-slide-to="2"></li>
		</ol>

		<div class="carousel-title"><i class="icon icon-newspaper"></i> {{ trans('home.views.index.news.title') }}</div>

		<div class="carousel-inner" role="listbox">
			<div class="item active">
				<h1>Ralat Penutupan Peti Sebutharga Bagi Kerja Gred G2 Pengkhususan CE21 &amp; CE01, MARRIS, Fasa 2 2016 (26 KERJA)</h1>
				<p class="text-muted">9 May 2016</p>
			</div>
			<div class="item">
				<h1>Ralat Penutupan Peti Sebutharga Bagi Kerja Gred G2 Pengkhususan CE21 &amp; CE01, MARRIS, Fasa 2 2016 (26 KERJA)</h1>
				<p class="text-muted">10 May 2016</p>
			</div>
			<div class="item">
				<h1>Ralat Penutupan Peti Sebutharga Bagi Kerja Gred G2 Pengkhususan CE21 &amp; CE01, MARRIS, Fasa 2 2016 (26 KERJA)</h1>
				<p class="text-muted">11 May 2016</p>
			</div>
		</div>

		<a class="left carousel-control" href="#carousel-news" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left text-slate-700" aria-hidden="true"></span>
			<span class="sr-only">{{ trans('actions.previous') }}</span>
		</a>

		<a class="right carousel-control" href="#carousel-news" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right text-slate-700" aria-hidden="true"></span>
			<span class="sr-only">{{ trans('actions.next') }}</span>
		</a>
	</div>
</div>
