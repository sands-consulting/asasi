<div role="tabpanel" class="tab-pane active form-horizonal" id="tab-notice-settings">
	<div class="panel panel-flat">
		<table class="table">
			<tr>
				<th width="5%">1</th>
				<td>{{ trans('notices.views.admin.form.settings.type') }}</td>
				<td class="col-xs-2">
					{!! Former::select('type_id')->label(false)->options(App\NoticeType::options()) !!}
				</td>
			</tr>

			<tr>
				<th>2</th>
				<td>{{ trans('notices.views.admin.form.settings.category') }}</td>
				<td>
					{!! Former::select('category_id')->label(false)->options(App\NoticeCategory::options()) !!}
				</td>
			</tr>

			<tr>
				<th>3</th>
				<td>{{ trans('notices.views.admin.form.settings.organization') }}</td>
				<td>
					{!! Former::select('organization_id')->label(false)->options(App\Organization::options()) !!}
				</td>
			</tr>

			<tr>
				<th>4</th>
				<td>{{ trans('notices.views.admin.form.settings.purchase') }}</td>
				<td><input type="checkbox" name="purchase" class="pull-right"></td>
			</tr>

			<tr>
				<th>5</th>
				<td>{{ trans('notices.views.admin.form.settings.submission') }}</td>
				<td><input type="checkbox" name="submission" class="pull-right"></td>
			</tr>

			<tr>
				<th>6</th>
				<td>{{ trans('notices.views.admin.form.settings.evaluation') }}</td>
				<td><input type="checkbox" name="evaluation" class="pull-right"></td>
			</tr>

			<tr>
				<th>7</th>
				<td>{{ trans('notices.views.admin.form.settings.award') }}</td>
				<td><input type="checkbox" name="award" class="pull-right"></td>
			</tr>

			<tr>
				<th rowspan="{{ App\EvaluationType::whereStatus('active')->count() + 1 }}">8</th>
				<td colspan="2">{{ trans('notices.views.admin.form.settings.evaluation-order') }}</td>
			</tr>

			@foreach(App\EvaluationType::whereStatus('active')->get() as $type)
			<tr>
				<td>{{ $loop->iteration }}. {{ $type->name }}</td>
				<td><input type="text" name="evaluation.{{ $type->slug }}" class="form-control"></td>
			</tr>
			@endforeach
		</table>
	</div>
</div>