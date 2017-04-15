<div role="tabpanel" class="tab-pane" id="tab-notice-files">
	<table class="table table-bordered table-striped table-vtop">
		<thead>
			<tr>
				<th class="col-xs-1">#</th>
				<th>{{ trans('notices.attributes.files.name') }}</th>
				<th>{{ trans('notices.attributes.files.type') }}</th>
				<th>{{ trans('notices.attributes.files.file') }}</th>
				<th width="140">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<tr v-for="(file, index) in files">
				<td>@{{ index + 1}}</td>
				<td><input type="text" v-bind:name="'files[' + index + '][name]'" class="form-control" v-model="file.name"></td>
				<td>
					<select v-bind:name="'files[' + index + '][type]'" class="form-control" v-model="file.type">
						@foreach(trans('notices.file-types') as $key => $value)<option value="{{ $key }}">{{ $value }}</option>@endforeach
					</select>
				</td>
				<td><input type="file" v-bind:name="'files[' + index + '][file]'" class="form-control" v-on:change="file.file"></td>
				<td>
					<div class="btn-group">
						<a href="#" class="btn btn-xs btn-default" @click.prevent="deleteFile(index)"><i class="icon-cross2"></i></a>
						<a v-bind:href="file.upload.url" class="btn btn-xs bg-blue-700" target="_blank" v-if="file.upload"><i class="icon-file-download"></i></a>
					</div>
					<input type="hidden" v-bind:name="'files[' + index + '][id]'" class="form-control" v-model="file.id">
				</td>
			</tr>
			<tr>
				<td colspan="6" align="center"><a href="#" @click.prevent="addFile"><i class="icon-plus-circle2"></i> {{ trans('notices.buttons.add-file') }}</a></td>
			</tr>
		</tbody>
	</table>
</div>