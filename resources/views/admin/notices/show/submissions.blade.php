<div role="tabpanel" class="tab-pane" id="tab-notice-submissions">
    <div class="panel panel-flat">
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
                    <td><input type="text" class="form-control" v-bind:name="'submissions[' + index + '][label]"></td>
                    <td>@{{ submission.vendor.name }}</td>
                    <td>@{{ submission.number }}</td>
                    <td>{{ setting('currency') }} @{{ numeral(submission.price).format('0,0.00') }}</td>
                    <td>@{{ moment(submission.submitted_at).format('DD/MM/YYYY HH:mm:ss') }}</td>
                </tr>
                @foreach(App\EvaluationType::active()->get() as $type)
                <tr>
                    @if($loop->first)<td rowspan="{{ $loop->count }}">&nbsp;</td>@endif
                    <td>{{ $type->name }}</td>
                    <td>
                        
                    </td>
                </tr>
                @endforeach
                </template>
                <tr v-if="submissions.length == 0">
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
    </div>
</div>
