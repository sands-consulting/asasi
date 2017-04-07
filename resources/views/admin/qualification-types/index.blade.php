@extends('layouts.admin')

@section('page-title', trans('qualification-types.title'))

@section('header')
<div class="page-title">
	<h4>{{ trans('qualification-types.title') }}</h4>
</div>
<div class="heading-elements">
	<div class="heading-btn-group">
		<a href="{{ route('admin.qualification-types.create') }}"
		   class="btn btn-link btn-float text-size-small has-text legitRipple">
			<i class=" icon-plus-circle2"></i> <span>{{ trans('qualification-types.buttons.create') }}</span>
		</a>
	</div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
	{!! $dataTable->table() !!}
</div>
@endsection

@section('scripts')
{!! $dataTable->scripts() !!}
@endsection