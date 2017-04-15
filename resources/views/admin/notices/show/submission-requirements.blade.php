<div role="tabpanel" class="tab-pane" id="tab-notice-submission-requirements">
    @foreach(App\EvaluationType::active()->get() as $type)

    <div class="panel panel-default">
        <div class="panel-heading">
            <h6 class="panel-title">{{ $type->name }}</h6>
        </div>
        <table class="table">
            <tbody>
                @forelse($notice->submissionRequirements()->whereTypeId($type->id)->orderBy('sequence')->get() as $requirement)
                    <tr class="{{ $requirement->field_required ? " danger" : "" }}">
                        <td width="5%">{{ $requirement->sequence }}</td>
                        <td>{{ $requirement->title }}</td>
                        <td class="text-right{{ $requirement->field_required ? " text-danger-700" : "" }}">
                            @if($requirement->field_type == 'checkbox')
                            <i class="icon-checkbox-checked"></i>
                            @endif

                            @if($requirement->field_type == 'file')
                            <i class="icon-file-upload"></i>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">{{ trans('notices.views.admin.submission-criterias.empty') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @endforeach
</div>