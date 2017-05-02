<div role="tabpanel" class="tab-pane" id="tab-notice-submissions">
    <form action="{{ route('admin.notices.submissions', $notice->id) }}" method="POST" id="form-submissions" class="panel panel-flat panel-form" v-cloak>
        {{ csrf_field() }}
        <table class="table">
            <thead>
                <th width="5%">#</th>
                <th>{{ trans('submissions.attributes.vendor') }}</th>
                <th>{{ trans('submissions.attributes.number') }}</th>
                <th>{{ trans('submissions.attributes.price') }}</th>
                <th>{{ trans('submissions.attributes.duration') }}</th>
                <th>{{ trans('submissions.attributes.submitted_at') }}</th>
                <th>{{ trans('submissions.attributes.label') }}</th>
            </thead>
            <tbody>
                <template v-for="(submission, index) in submissions">
                <tr>
                    <td>@{{ index+ 1 }}</td>
                    <td>@{{ submission.vendor.name }}</td>
                    <td>
                        <i class="icon-cross2" v-if="!submission.number"></i>
                        <span v-if="submission.number">@{{ submission.number }}</span>
                    </td>
                    <td>{{ setting('currency') }} @{{ submission.price.format('0,0.00') }}</td>
                    <td>
                        <i class="icon-cross2" v-if="!submission.duration_in_text"></i>
                        <span v-if="submission.duration_in_text">@{{ submission.duration_in_text }}</span>
                    </td>
                    <td>
                        <i class="icon-cross2" v-if="!submission.submitted_at"></i>
                        <span v-if="submission.submitted_at">@{{ submission.submitted_at.format('DD/MM/YYYY HH:mm:ss') }}</span>
                    </td>
                    <td><input type="text" class="form-control" v-bind:name="'labels[' + submission.id + ']'" v-model="submission.label"></td>
                </tr>
                @if(setting('evaluation', false, $notice))
                @foreach(App\EvaluationType::active()->get() as $type)
                <tr v-if="submission.status == 'submitted'">
                    @if($loop->first)<td rowspan="{{ $loop->count }}" class="bg-slate-300">&nbsp;</td>@endif
                    <td>{{ $type->name }} {{ trans('notices.views.admin.show.submissions.evaluators') }}</td>
                    <td colspan="4">
                        <select class="form-control evaluators" multiple="multiple" v-bind:name="'evaluators[' + submission.id + '][{{ $type->id }}][]'">
                            @foreach(App\User::whereHas('roles', function($query) {
                                $query->whereHas('permissions', function($query) {
                                    $query->whereName('evaluation:index');
                                });
                            })->whereHas('organizations', function($query) use($notice) {
                                $query->whereId($notice->organization_id);
                            })->get() as $user)
                            <option value="{{ $user->id }}" @if(in_array($user->id, $notice->evaluations()->where('status', '!=', 'cancelled')->whereTypeId($type->id)->pluck('user_id')->toArray())) selected="selected" @endif>{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <span class="help-block">{{ trans('notices.views.admin.show.submissions.select-evaluator') }}</span>
                    </td>
                </tr>
                @endforeach
                @endif
                </template>
                <tr v-if="submissions.length == 0">
                    <td colspan="6" align="center">
                        {{ trans('notices.views.admin.show.submissions.empty') }}
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="panel-footer" v-if="submissions.length > 0">
            <a href="#" @click.prevent="save" class="btn bg-blue-700 pull-right">{{ trans('actions.save') }}</a>
            @if(setting('evaluation', false, $notice))
            <select id="status_submission" name="status_submission" class="form-control pull-right">
                <option selected="selected" disabled>{{ trans('notices.attributes.status') }}</option>
                <option value="published" @if($notice->status_submission == 'published') selected="selected" @endif>{{ trans('statuses.published') }}</option>
                <option value="pending" @if($notice->status_submission == 'pending') selected="selected" @endif>{{ trans('statuses.pending') }}</option>
            </select>
            @endif
        </div>
    </form>
</div>
