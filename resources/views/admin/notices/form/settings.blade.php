<div role="tabpanel" class="tab-pane active panel-body" id="tab-notice-settings">
	<div class="row">
		<div class="col-xs-12 col-md-6">
			{!! Former::select('type_id')->label('notices.views.admin.form.settings.type')->options(App\NoticeType::options()) !!}
			{!! Former::select('category_id')->label('notices.views.admin.form.settings.category')->options(App\NoticeCategory::options()) !!}
			@unless(Auth::user()->hasPermission('notice:organziation'))
			{!! Former::select('organization_id')->label('notices.views.admin.form.settings.organization')->options(App\Organization::options()) !!}
			@endunless
			{!! Former::hidden('invitation')->forceValue(0) !!}
			{!! Former::checkbox('invitation')->label('notices.views.admin.form.settings.invitation')->inline()->addClass('pull-right')->forceValue(1)->vModel('notice.invitation') !!}
		</div>

		<div class="col-xs-12 col-md-6">
			{!! Former::hidden('settings[purchase]')->value(0) !!}
			{!! Former::checkbox('settings[purchase]')->label('notices.views.admin.form.settings.purchase')->inline()->addClass('pull-right')->forceValue(1)->vModel('settings.purchase') !!}
			{!! Former::hidden('settings[submission]')->value(0) !!}
			{!! Former::checkbox('settings[submission]')->label('notices.views.admin.form.settings.submission')->inline()->addClass('pull-right')->forceValue(1)->vModel('settings.submission')->setAttribute('v-bind:checked', 'settings.submission') !!}

			<template v-if="settings.submission">
			{!! Former::select('settings[duration]')->label('notices.views.admin.form.settings.duration')->options(trans('app.durations')) !!}
			</template>
			
			{!! Former::hidden('settings[evaluation]')->value(0) !!}
			{!! Former::checkbox('settings[evaluation]')->label('notices.views.admin.form.settings.evaluation')->inline()->addClass('pull-right')->forceValue(1)->vModel('settings.evaluation') !!}

			<table class="table table-bordered table-condensed mb-10" v-if="settings.evaluation">
				<thead>
					<tr class="bg-blue-700">
						<th colspan="4">{{ trans('notices.views.admin.form.settings.evaluation-settings') }}</th>
					</tr>
					<tr>
						<th>{{ trans('notices.attributes.evaluation-types.type') }}</th>
						<th>{{ trans('notices.attributes.evaluation-types.start_at') }}</th>
						<th>{{ trans('notices.attributes.evaluation-types.end_at') }}</th>
						<th>{{ trans('notices.attributes.evaluation-types.weightage') }}</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="type in evaluationTypes">
						<td>
							@{{ type.name }}
							<input type="hidden" v-bind:name="'notice-evaluations[' + type.slug + '][type_id]'" v-model="noticeEvaluations[type.slug].type_id">
						</td>
						<td><datepicker-single klass="form-control" v-bind:name="'notice-evaluations[' + type.slug + '][start_at]'" :date="noticeEvaluations[type.slug].start_at"></datepicker-single></td>
						<td><datepicker-single klass="form-control" v-bind:name="'notice-evaluations[' + type.slug + '][end_at]'" :date="noticeEvaluations[type.slug].end_at"></datepicker-single></td>
						<td><input type="text" v-bind:name="'notice-evaluations[' + type.slug + '][weightage]'" v-model="type.weightage" class="form-control"></td>
					</tr>
				</tbody>
			</table>

			{!! Former::hidden('settings[award]')->value(0) !!}
			{!! Former::checkbox('settings[award]')->label('notices.views.admin.form.settings.award')->inline()->addClass('pull-right')->forceValue(1)->vModel('settings.award') !!}
		</div>
	</div>
</div>
