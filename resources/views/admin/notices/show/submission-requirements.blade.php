<div role="tabpanel" class="tab-pane" id="tab-notice-submission-requirements">
    @foreach(App\EvaluationType::active()->get() as $type)

    <div class="panel panel-default">
        <div class="panel-heading">
            <h6 class="panel-title">{{ $type->name }}</h6>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th>{{ trans('notices.attributes.submission-requirements.title') }}</th>
                    <th class="col-xs-1 text-right">{{ trans('notices.attributes.submission-requirements.field') }}</th>
                    <th class="col-xs-1 text-right">{{ trans('notices.attributes.submission-requirements.required') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($notice->submissionRequirements()->whereTypeId($type->id)->orderBy('sequence')->get() as $requirement)
                    <tr>
                        <td width="5%">{{ $requirement->sequence }}</td>
                        <td>{{ $requirement->title }}</td>
                        <td class="text-right">
                            @if($requirement->field_type == 'checkbox')
                            <i class="icon-checkbox-checked"></i>
                            @endif

                            @if($requirement->field_type == 'file')
                            <i class="icon-file-upload"></i>
                            @endif
                        </td>
                        <td class="text-right">{!! boolean_icon($requirement->field_required) !!}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">{{ trans('notices.views.admin.show.submission-requirements.empty') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @endforeach
</div>