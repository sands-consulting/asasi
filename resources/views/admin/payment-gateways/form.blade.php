<div class="row">
	<div class="col-xs-12 col-md-6">
		{!! Former::text('name')->label('payment-gateways.attributes.name')->required() !!}
		{!! Former::select('type')->label('payment-gateways.attributes.type')->options(trans('payment-gateways.types'))->required() !!}
		{!! Former::text('label')->label('payment-gateways.attributes.label')->required() !!}
		{!! Former::text('prefix')->label('payment-gateways.attributes.prefix')->required() !!}
		{!! Former::checkbox('default')->label('payment-gateways.attributes.default') !!}
		{!! Former::hidden('default')->forceValue(0) !!}
		{!! Former::select('status')->label('payment-gateways.attributes.status')->options(collect(trans('statuses'))->only('active', 'inactive'))->required() !!}
	</div>

	<div class="col-xs-12 col-md-6">
		<div class="form-group required">
			<label class="control-label col-md-4 col-xs-12">{{ trans('payment-gateways.attributes.settings')}}</label>
			<div class="col-md-8 col-xs-0">
				<table id="form-settings" class="table table-bordered" v-cloak>
					<thead>
						<tr>
							<th>{{ trans('settings.attributes.key') }}</th>
							<th>{{ trans('settings.attributes.value') }}</th>
							<th>&nbsp;
						</tr>
					</thead>
					<tbody>
						<tr v-for="(setting, index) in settings">
							<td><input type="text" v-bind:name="'settings[' + index + '][key]'" class="form-control" v-model="setting.key"></td>
							<td><input type="text" v-bind:name="'settings[' + index + '][value]'" class="form-control" v-model="setting.value"></td>
							<td><a href="#" class="btn btn-xs bg-danger" @click.prevent="deleteSetting(index)"><i class="icon-cross2"></i></a></td>
						</tr>
						<tr>
							<td class="text-center" colspan="3">
								<a href="#" @click.prevent="addSetting"><i class="icon-plus-circle2"></i> {{ trans('payment-gateways.buttons.add-setting') }}</a>
							</td>
					</tbody>
				</table>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-md-4 col-xs-12">{{ trans('payment-gateways.attributes.organizations')}}</label>
			<div class="col-md-8 col-xs-0">
				@foreach(App\Organization::all() as $organization)
				<div class="checkbox">
					<label>
						<input type="checkbox" name="organizations[]" value="{{ $organization->id }}" @if($gateway->organizations->contains($organization->id)) checked="checked" @endif >
						{{ $organization->name }}
					</label>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>

{!! Former::submit(trans('actions.save'))->addClass('bg-blue')->data_confirm(trans('app.confirmation')) !!}
{!! link_to_route('admin.payment-gateways.index', trans('actions.cancel'), [], ['class' => 'btn btn-default']) !!}
