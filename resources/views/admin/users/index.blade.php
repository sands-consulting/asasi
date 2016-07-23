@extends('layouts.admin')

@section('header')
<div class="page-title">
	<h4>{{ trans('users.title') }}</h4>
</div>
<div class="heading-elements">
	<div class="heading-btn-group">
		<a href="{{ route('admin.users.create') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
			<i class=" icon-user-plus"></i> <span>{{ trans('users.buttons.create') }}</span>
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