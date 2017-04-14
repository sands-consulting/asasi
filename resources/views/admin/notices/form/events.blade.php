<div role="tabpanel" class="tab-pane" id="tab-notice-events">
	<table class="table table-bordered table-striped table-vtop">
		<thead>
			<tr>
				<th class="col-xs-1">#</th>
				<th>{{ trans('notices.attributes.events.name') }}</th>
				<th>{{ trans('notices.attributes.events.schedule_at') }}</th>
				<th>{{ trans('notices.attributes.events.type') }}</th>
				<th>{{ trans('notices.attributes.events.location') }}</th>
				<th width="40">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<tr v-for="(event, index) in events">
				<td>@{{ index + 1}}</td>
				<td>
					<input type="text" v-bind:name="'events[' + index + '][name]'" class="form-control" v-model="event.name">
					<br>
					<input type="hidden" v-bind:name="'events[' + index + '][required]'" value="0">
					<label>
						<input type="checkbox" v-bind:name="'events[' + index + '][required]'" v-bind:checked="event.required" value="1">
						{{ trans('notices.attributes.events.required') }}
					</label>
				</td>
				<td>
					<datetimepicker-single klass="form-control" v-bind:name="'events[' + index + '][schedule_at]'" :date="event.schedule_at"></datetimepicker-single>
				</td>
				<td>
					<select v-bind:name="'events[' + index + '][type_id]'" class="form-control" v-model="event.type_id">
						@foreach(App\NoticeEventType::options() as $key => $value)<option value="{{ $key }}">{{ $value }}</option>@endforeach
					</select>
				</td>
				<td>
					<textarea v-bind:name="'events[' + index + '][location]'" class="form-control" v-model="event.location" rows="5"></textarea>
				</td>
				<td>
					<a href="#" class="btn btn-xs btn-default" @click.prevent="deleteEvent(index)"><i class="icon-cross2"></i></a>
					<input type="hidden" v-bind:name="'events[' + index + '][id]'" class="form-control" v-model="event.id">
				</td>
			</tr>
			<tr>
				<td colspan="6" align="center"><a href="#" @click.prevent="addEvent"><i class="icon-plus-circle2"></i> {{ trans('notices.buttons.add-event') }}</a></td>
			</tr>
		</tbody>
	</table>
</div>