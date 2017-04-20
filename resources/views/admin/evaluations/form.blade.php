<div class="tab-pane active" id="tab-evaluation">
    <div class="panel panel-flat panel-form">
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
                        <input type="number" name="scores[{{ $requirement->id }}][score]" max="{{ $requirement->full_score }}" class="form-control">
                        @if($requirement->required)<br><span class="text-danger"><i class="icon-checkmark2"></i> {{ trans('evaluations.attributes.required') }}</span>@endif
                    </td>
                    <td><textarea name="scores[{{ $requirement->id }}][remarks]" class="form-control" rows="5"></textarea></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="panel-footer">
            <input type="submit" value="{{ trans('actions.save') }}" class="btn bg-blue-700 pull-right">
        </div>
    </div>
</div>