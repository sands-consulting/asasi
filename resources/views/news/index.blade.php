@extends('layouts.portal')

@section('ahead')
    @include('layouts.portal.aheads.public')
@endsection

@section('content')
@include('layouts.menu.portal')

<div class="panel panel-flat">
	<div class="row">
		@foreach($news as $n)
		<div class="col-xs-12 col-md-3">
			<a href="{{ route('news.show', $n->slug) }}" class="news">
				<span class="category label bg-blue-700">{{ $n->category->name }}</span>

				<div class="date">{{ $n->created_at->format('d M Y') }}</div>
				<div class="title">{{ $n->title }}</div>
			</a>
		</div>
		@endforeach
	</div>

	<div class="text-center">{{ $news->links() }}</div>
</div>
@endsection
