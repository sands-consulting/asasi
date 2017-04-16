<div role="tabpanel" class="tab-pane" id="tab-notice-submissions">
    <form action="{{ route('admin.notices.submissions', $notice->id) }}" method="POST" id="form-submissions" class="panel panel-flat" v-cloak>
        {{ csrf_field() }}
        <table class="table">
            <thead>
                <th width="5%">#</th>
                <th>{{ trans('submissions.attributes.label') }}</th>
                <th>{{ trans('submissions.attributes.vendor') }}</th>
                <th>{{ trans('submissions.attributes.number') }}</th>
                <th>{{ trans('submissions.attributes.price') }}</th>
                <th>{{ trans('submissions.attributes.submitted_at') }}</th>
            </thead>
            <tbody>
                <template v-for="(submission, index) in submissions">
                <tr>
                    <td>@{{ index+ 1 }}</td>
                    <td><input type="text" class="form-control" v-bind:name="'labels[' + submission.id + ']'" v-model="submission.label"></td>
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
                @foreach(App\EvaluationType::active()->get() as $type)
                <tr v-if="submission.status == 'completed'">
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
                            <option value="{{ $user->id }}" @if(in_array($user->id, $notice->evaluators($type->id))) selected="selected" @endif>{{ $user->name }}</option>
                            @endforeach
                        </select>
                        </select>
                    </td>
                </tr>
                @endforeach
                </template>
                <tr v-if="submissions.length > 0">
                    <td colspan="6" align="center">
                        <a href="#" @click.prevent="save"><i class="icon-floppy-disk"></i> {{ trans('actions.save') }}</a>
                    </td>
                </tr>
                <tr v-if="submissions.length == 0">
                    <td colspan="6" align="center">
                        {{ trans('notices.views.admin.show.submissions.empty') }}
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
