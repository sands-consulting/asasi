@if(Auth::user()->hasPermission('access:vendor'))
<div class="row">
	<div class="col-xs-12 col-md-8">
		@include('dashboard._news')
	</div>
	<div class="col-xs-12 col-md-4">
		@include('dashboard._vendor')
	</div>
</div>

@include('dashboard._numbers')
@endif