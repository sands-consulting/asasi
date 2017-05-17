@extends('layouts.app')

@section('page-title', trans('settings.title'))

@section('header')
<div class="page-title">
	<h4>{{ trans('settings.title') }}</h4>
</div>
@endsection

@section('content')
<div class="row">
	<div class="col-xs-12 col-md-6">
		{!! Former::open(route('settings'))->method('PUT')->addClass('panel panel-default panel-form') !!}
			<div class="panel-heading">
				<h4 class="panel-title">{{ trans('settings.views.edit.system.title') }}</h4>
			</div>
			<div class="panel-body">
				{!! Former::text('settings[app_name]')->label('settings.system.app_name')->value(setting('app_name'))->required() !!}
				{!! Former::text('settings[currency]')->label('settings.system.currency')->value(setting('currency'))->required() !!}
				{!! Former::text('settings[date_format]')->label('settings.system.date_format')->value(setting('date_format'))->required() !!}
				{!! Former::text('settings[datetime_format]')->label('settings.system.datetime_format')->value(setting('datetime_format'))->required() !!}
				{!! Former::select('settings[vendor_role_id]')->label('settings.system.vendor_role_id')->value(setting('vendor_role_id'))->options(App\Role::options())->required() !!}
			</div>
			<div class="panel-footer">
				{!! Former::submit(trans('actions.save'))->addClass('bg-blue-700 pull-right') !!}
			</div>
		{!! Former::close() !!}
	</div>

	<div class="col-xs-12 col-md-6">
		{!! Former::open(route('license'))->method('PUT')->addClass('panel panel-default panel-form') !!}
			<div class="panel-heading">
				<h4 class="panel-title">{{ trans('settings.views.edit.license.title') }}</h4>
			</div>
			<table class="table">
				<tr>
					<th class="col-xs-3">{{ trans('settings.license.name') }}</th>
					<td>SANDS Consulting Sdn Bhd</td>
				</tr>
				<tr>
					<th class="col-xs-3">{{ trans('settings.license.url') }}</th>
					<td>prompt.demo.my-sands.com</td>
				</tr>
				<tr>
					<th class="col-xs-3">{{ trans('settings.license.validity') }}</th>
					<td>01/01/2016 - 31/12/2050</td>
				</tr>
				<tr>
					<th class="col-xs-3">{{ trans('settings.license.modules') }}</th>
					<td>
						<ul class="list-unstyled">
							<li><i class="icon-checkmark2"></i> {{ trans('settings.modules.vendor') }}</li>
							<li><i class="icon-checkmark2"></i> {{ trans('settings.modules.notice') }}</li>
							<li><i class="icon-checkmark2"></i> {{ trans('settings.modules.purchase') }}</li>
							<li><i class="icon-checkmark2"></i> {{ trans('settings.modules.submission') }}</li>
							<li><i class="icon-checkmark2"></i> {{ trans('settings.modules.evaluation') }}</li>
							<li><i class="icon-checkmark2"></i> {{ trans('settings.modules.award') }}</li>
							<li><i class="icon-checkmark2"></i> {{ trans('settings.modules.project') }}</li>
						</ul>
					</td>
				</tr>
				<tr>
					<th>{{ trans('settings.views.edit.license.upload') }}</th>
					<td><i class="icon-cross3"></i></td>
				</tr>
			</table>
			<div class="panel-footer text-muted text-center">
				{{ trans('settings.views.edit.license.disabled') }}
			</div>
		{!! Former::close() !!}
	</div>
</div>
@endsection