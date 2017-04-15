<div role="tabpanel" class="tab-pane qualification-wrap" id="tab-notice-qualifications">

@forelse($notice->qualificationCodes->groupBy('group') as $group)

	@if($group->count() > 1)<div class="qualification-group">@endif

		@foreach($group as $code)
		<div class="panel panel-default">
			<div class="panel-heading">
				<h6 class="panel-title">{{ $code->type->name }}</h6>
			</div>
			@if($code->type->type == 'list')
			<table class="table table-bordered">
				<tr>
					<th class="col-xs-1">{{ $code->code->code }}</th>
					<td>{{ $code->code->name }}</td>
				</tr>
			</table>
			@endif
		</div>

		@if($group->count() > 1 && !$loop->last)
		
			<div class="qualification-rule qualification-rule-{{ $group->first()->group_rule }}">
				<span>
					{{ trans('notices.views.admin.qualifications.rules.' . $group->first()->group_rule) }}
				</span>
			</div>
		
		@endif
		
		@endforeach

	@if($group->count() > 1)</div>@endif

	@unless($loop->last)

		<div class="qualification-rule qualification-rule-{{ $group->first()->join_rule }}">
			<span>
				{{ trans('notices.views.admin.qualifications.rules.' . $group->first()->join_rule) }}
			</span>
		</div>

	@endunless

@empty

	<div class="panel panel-flat">
		<div class="panel-body">
			{{ trans('notices.views.admin.qualifications.empty') }}
		</div>
	</div>

@endforelse

</div>