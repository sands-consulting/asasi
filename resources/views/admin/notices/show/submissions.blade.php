<div role="tabpanel" class="tab-pane" id="tab-notice-submissions">
    <form action="{{ route('admin.notices.submissions', $notice->id) }}" method="POST" id="form-submissions" class="panel panel-flat panel-form" v-cloak>
        {{ csrf_field() }}
        <table class="table">
            <thead>
                <th width="5%">#</th>
                <th>{{ trans('submissions.attributes.vendor') }}</th>
                <th>{{ trans('submissions.attributes.number') }}</th>
                <th>{{ trans('submissions.attributes.price') }}</th>
                <th>{{ trans('submissions.attributes.submitted_at') }}</th>
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
                        <i class="icon-cross2" v-if="!submission.submitted_at"></i>
                        <span v-if="submission.submitted_at">@{{ submission.submitted_at.format('DD/MM/YYYY HH:mm:ss') }}</span>
                    </td>
                </tr>
                <tr v-if="submission.status == 'submitted'">
                    <td rowspan="{{ App\EvaluationType::active()->count() + 1 }}" class="bg-slate-300">&nbsp;</td>
                    <td>{{ trans('submissions.attributes.label') }}</td>
                    <td colspan="3"><input type="text" class="form-control" v-bind:name="'labels[' + submission.id + ']'" v-model="submission.label"></td>
                </tr>
                @foreach(App\EvaluationType::active()->get() as $type)
                <tr v-if="submission.status == 'submitted'">
                    <td>{{ $type->name }} {{ trans('notices.views.admin.show.submissions.evaluators') }}</td>
                    <td colspan="3">
                        <select class="form-control evaluators" multiple="multiple" v-bind:name="'evaluators[' + submission.id + '][{{ $type->id }}][]'">
                            @foreach(App\User::whereHas('roles', function($query) {
                                $query->whereHas('permissions', function($query) {
                                    $query->whereName('evaluation:index');
                                });
                            })->whereHas('organizations', function($query) use($notice) {
                                $query->whereId($notice->organization_id);
                            })->get() as $user)
                            <option value="{{ $user->id }}" @if(in_array($user->id, $notice->evaluators($type->id))) selected="selected" @endif>{{ $user->name }}</option>
                            @endforeach
                        </select>
                        </select>
                    </td>
                </tr>
                @endforeach
                </template>
                <tr v-if="submissions.length == 0">
                    <td colspan="65" align="center">
                        {{ trans('notices.views.admin.show.submissions.empty') }}
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="panel-footer" v-if="submissions.length > 0">
            <a href="#" @click.prevent="save" class="btn bg-blue-700 pull-right">{{ trans('actions.save') }}</a>
            <select id="status_submission" name="status_submission" class="form-control pull-right">
                <option selected="selected" disabled>{{ trans('notices.attributes.status') }}</option>
                <option value="published" @if($notice->status_submission == 'published') selected="selected" @endif>{{ trans('statuses.published') }}</option>
                <option value="pending" @if($notice->status_submission == 'pending') selected="selected" @endif>{{ trans('statuses.pending') }}</option>
            </select>
        </div>
    </form>
</div>
