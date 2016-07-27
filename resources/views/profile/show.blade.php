@extends('layouts.window')

@section('page-title', trans('profile.title'))

@section('content')
<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title">{{ trans('profile.title') }}</h5>
		<div class="heading-elements">
			{!! link_to_route('profile.edit', trans('actions.edit'), [], ['class' => 'btn bg-blue legitRipple']) !!}
		</div>
	</div>
	<div class="table-responsive">
		<table class="table">
			<tr>
				<th class="col-xs-3">{{ trans('profile.attributes.name') }}</th>
				<td>{{ $user->name }}</td>
			</tr>
			<tr>
				<th class="col-xs-3">{{ trans('profile.attributes.email') }}</th>
				<td>{{ $user->email }}</td>
			</tr>
			<tr>
				<th class="col-xs-3">{{ trans('profile.attributes.roles') }}</th>
				<td>@include('admin.users._index_roles')</td>
			</tr>
			<tr>
				<th class="col-xs-3">{{ trans('profile.attributes.created_at') }}</th>
				<td>{{ $user->created_at->format('d/m/Y H:i:s') }}</td>
			</tr>
			<tr>
				<th class="col-xs-3">{{ trans('profile.attributes.updated_at') }}</th>
				<td>{{ $user->updated_at->format('d/m/Y H:i:s') }}</td>
			</tr>
		</table>
	</div>
</div>
@endsection
