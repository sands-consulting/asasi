<div role="tabpanel" class="tab-pane" id="vendor-files">
	<div class="panel panel-white">
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th class="col-xs-1">#</th>
					<th>{{ trans('vendors.attributes.files.name') }}</th>
					<th>{{ trans('vendors.attributes.files.file') }}</th>
				</tr>
			</thead>
			<tbody>
				<?php $index = 1; ?>
				@foreach(App\FileType::whereStatus('active')->get() as $file)
				<tr>
					<td>{{ $index }}</td>
					<td>{{ $file->display_name }}</td>
					<td>
						<input class="form-control" type="file" name="files[{{ $file->name }}]">
						<p class="help-block">Please upload a copy of your company {{ $file->description }}</p>
					</td>
				</tr>
				<?php $index++; ?>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
