@extends('layouts.portal')

@section('ahead')
    @include('layouts.portal.aheads.public')
@endsection

@section('content')
@include('layouts.menu.portal')

<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title">{{ $news->title }}</h6>
		<div class="text-muted">{{ $news->created_at->format('d M Y') }} &bullet; {{ $news->category->name }}</div>
	</div>
	<div class="panel-body">
		<p class="text-muted">{{ $news->summary }}</p>
		{!! $news->content !!}
	</div>
</div>
@endsection
