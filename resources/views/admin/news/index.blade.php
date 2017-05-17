@extends('layouts.app')

@section('page-title', trans('news.title'))

@section('header')
<div class="page-title">
	<h4>{{ trans('news.title') }}</h4>
</div>
<div class="heading-elements">
	<div class="heading-btn-group">
		<a href="{{ route('admin.news.create') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
			<i class=" icon-plus-circle2"></i> <span>{{ trans('news.buttons.create') }}</span>
		</a>
	</div>
</div>
@endsection

@section('secondary-header')
<ul class="breadcrumb breadcrumb-caret">
    <li><a href="{{ route('admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
    <li class="active">{{ trans('news.title') }}</li>
</ul>
<ul class="breadcrumb-elements">
    {{-- <li>
        <a href="{{ route('admin.users.archives') }}" class="legitRipple">
            <i class="icon-trash"></i> {{ trans('news.views.archives.link') }}
        </a>
    </li> --}}
</ul>
@endsection

@section('content')
<div class="panel panel-flat">
	{!! $dataTable->table() !!}
</div>
@endsection

@section('scripts')
{!! $dataTable->scripts() !!}
@endsection