<div class="tab-pane" id="tab-submission">
    <div class="panel panel-flat">
        <table class="table table-vtop">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('evaluations.attributes.requirement') }}</th>
                    <th class="col-xs-2">{{ trans('evaluations.attributes.score') }}</th>
                    <th class="col-xs-2">{{ trans('evaluations.attributes.remarks') }}</th>
                </tr>
            </thead>
            <tbody>
            @foreach($evaluation->notice->evaluationRequirements()->whereTypeId($evaluation->type_id)->whereStatus('active')->orderBy('sequence')->get() as $requirement)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $requirement->title }}</td>
                    <td>
                        <input type="number" name="scores[{{ $requirement->id }}][score]" max="{{ $requirement->full_score }}" class="form-control" value="{{ $evaluation->getScore($requirement->id) }}">
                        @if($requirement->required)<br><span class="text-danger"><i class="icon-checkmark2"></i> {{ trans('evaluations.attributes.required') }}</span>@endif
                    </td>
                    <td><textarea name="scores[{{ $requirement->id }}][remarks]" class="form-control" rows="5">{{ $evauation->remarks }}</textarea></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>