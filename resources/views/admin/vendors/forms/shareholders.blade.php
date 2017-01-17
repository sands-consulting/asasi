<div role="tabpanel" class="tab-pane" id="vendor-shareholders">
	<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<th class="col-xs-1">#</th>
				<th>{{ trans('vendors.attributes.shareholders.name') }}</th>
				<th>{{ trans('vendors.attributes.shareholders.identity_number') }}</th>
				<th>{{ trans('vendors.attributes.shareholders.nationality') }}</th>
				<th width="40">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<tr v-for="shareholder in shareholders">
				<td>@{{ $index + 1}}</td>
				<td><input type="text" name="shareholders[@{{ $index }}][name]" class="form-control" v-model="shareholder.name"></td>
				<td><input type="text" name="shareholders[@{{ $index }}][identity_number]" class="form-control" v-model="shareholder.identity_number"></td>
				<td>
					<select name="shareholders[@{{ $index }}][nationality_id]" class="form-control select2" v-model="shareholder.nationality_id">
						@foreach(App\Place::type('country')->active()->lists('name', 'id') as $key => $value)
						<option value="{{ $key }}">{{ $value }}</option>
						@endforeach
					</select>
				</td>
				<td>
					<a href="#" class="btn btn-xs btn-default" @click.prevent="deleteItem(shareholders, $index)"><i class="icon-cross2"></i></a>
					<input type="hidden" name="shareholders[@{{ $index }}][id]" class="form-control" v-model="shareholder.id">
				</td>
			</tr>
			<tr>
				<td colspan="5" align="center"><a href="#" @click.prevent="addShareholder"><i class="icon-plus-circle2"></i> {{ trans('vendors.buttons.add-shareholder') }}</a></td>
			</tr>
		</tbody>
	</table>
</div>