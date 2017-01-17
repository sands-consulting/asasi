@foreach(App\QualificationCodeType::roots()->whereStatus('active')->get() as $type)
@if($type->type == 'list' && $vendor->qualificationCodes()->whereTypeId($type->id)->count())
<div class="panel panel-white">
	<div class="panel-heading">
		<h6 class="panel-title">{{ $type->name }}</h6>
	</div>
	<table class="table table-bordered table-striped table-condensed">
		<?php $index = 1; ?>
		<tbody>
		@foreach($vendor->qualificationCodes()->whereTypeId($type->id)->get() as $code)
			<tr>
				<td>{{ $index }}</td>
				<td>
					<strong>{{ $code->code->code }}</strong> {{ $code->code->name }}

					@foreach($type->getImmediateDescendants() as $child)
					@if($code->children()->whereTypeId($child->id)->count())
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title">{{ $child->name }}</h6>
						</div>
						<table class="table table-bordered table-striped table-condensed">
							<thead>
								<tr>
									<th class="col-xs-1">#</th>
									<th class="col-xs-2">Code</th>
									<th>Name</th>
								</tr>
							</thead>
							<?php $childIndex = 1; ?>
							<tbody>
								@foreach($code->children()->whereTypeId($child->id)->get() as $childCode)
								<tr>
									<td>{{ $childIndex }}</td>
									<td>{{ $childCode->code->code }}</td>
									<td>{{ $childCode->code->name }}</td>
								</tr>
								<?php $childIndex++; ?>
								@endforeach
							</tbody>
						</table>
					</tbody>
					@endif
					@endforeach
				</td>
			</tr>
			<?php $index++; ?>
		@endforeach
		</tbody>
	</table>
</div>
@endif

@if($type->type == 'boolean' && $vendor->qualificationCodes()->whereTypeId($type->id)->count())
<div class="panel panel-flat">
	<div class="panel-heading">
		<h6 class="panel-title">
			{{ $type->name }}
			<i class="icon-checkmark3 text-success pull-right"></i>
		</h6>
	</div>
</div>
@endif
@endforeach