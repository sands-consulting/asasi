@if(Auth::check() && Auth::user()->hasPermission('access:vendor'))
<div class="row">
	<div class="col-xs-12 col-md-8">
		@include('layouts.portal.widgets.news')
	</div>
	<div class="col-xs-12 col-md-4">
		@include('layouts.portal.widgets.vendor')
	</div>
</div>

@include('layouts.portal.widgets.numbers')
@endif