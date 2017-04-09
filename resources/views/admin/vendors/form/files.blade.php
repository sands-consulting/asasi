<div role="tabpanel" class="tab-pane" id="tab-vendor-files">
	<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<th class="col-xs-1">#</th>
				<th>{{ trans('vendors.attributes.files.type') }}</th>
				<th>{{ trans('vendors.attributes.files.file') }}</th>
				<th width="140">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<tr v-for="(file, index) in files">
				<td>@{{ index + 1}}</td>
				<td>
					<select v-bind:name="'files[' + index + '][type_id]'" class="form-control" v-model="file.type_id">
						@foreach(App\FileType::getOptions() as $key => $value)
						<option value="{{ $key }}">{{ $value }}</option>
						@endforeach
					</select>
				</td>
				<td>
					<input type="file" v-bind:name="'files[' + index + '][file]'" class="form-control" v-on:change="file.file">
					<input type="hidden" v-bind:name="'files[' + index + '][id]'" class="form-control" v-model="file.id">
					
				</td>
				<td class="text-right">
					<div class="btn-group">
						<a href="#" class="btn btn-xs btn-default" @click.prevent="deleteFile(index)"><i class="icon-cross2"></i></a>
						<a v-bind:href="file.upload.url" class="btn btn-xs bg-blue-700" target="_blank" v-if="file.upload"><i class="icon-file-download"></i></a>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="6" align="center">
				<a href="#" @click.prevent="addFile"><i class="icon-plus-circle2"></i> {{ trans('vendors.buttons.add-file') }}</a></td>
			</tr>
		</tbody>
	</table>
</div>