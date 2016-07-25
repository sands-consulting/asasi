@extends('layouts.public')

@section('content')
<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title">
			{{ link_to_route('account', trans('account.title')) }} /
			<span class="text-semibold">{{ trans('actions.edit') }}
		</h5>
		<div class="heading-elements">
			{!! link_to_route('account', trans('actions.cancel'), [], ['class' => 'btn bg-primary legitRipple']) !!}
		</div>
	</div>
	<div class="panel-body">
		{!! Former::open(route('account'))->method('PUT') !!}
			{!! Former::populate($user) !!}
			{!! Former::text('email')->label('account.attributes.email')->disabled() !!}
			{!! Former::text('name')->label('account.attributes.name')->required() !!}
			{!! Former::password('password')->label('account.attributes.password') !!}
			{!! Former::password('password_confirmation')->label('account.attributes.password_confirmation') !!}
			{!! Former::password('current_password')->label('account.attributes.current_password') !!}
			<div class="form-group">
				<div class="col-lg-10 col-sm-8 col-lg-offset-2 col-sm-offset-4">
					{!! Former::submit(trans('actions.save'))->addClass('bg-blue')->data_confirm(trans('app.confirmation')) !!}
					{!! link_to_route('account', trans('actions.cancel'), $user->id, ['class' => 'btn btn-default']) !!}
				</div>
			</div>	
		{!! Former::close() !!}
	</div>
</div>
@endsection
