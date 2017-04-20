<div class="tab-pane active" id="tab-evaluation">
    {!! Former::open(route('admin.evaluations.update', $evaluation->id))->addClass('panel panel-flat panel-form')->method('PUT') !!}
        <table class="table table-vtop">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('evaluations.attributes.requirement') }}</th>
                    <th class="col-xs-1 text-right">{{ trans('evaluations.attributes.required') }}</th>
                    <th class="col-xs-2">{{ trans('evaluations.attributes.score') }}</th>
                    <th class="col-xs-3">{{ trans('evaluations.attributes.remarks') }}</th>
                </tr>
            </thead>
            <tbody>
            @foreach($evaluation->notice->evaluationRequirements()->type($evaluation->type_id)->whereStatus('active')->orderBy('sequence')->get() as $requirement)
                <tr class="border-left-danger">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $requirement->title }}</td>
                    <td class="text-right">{!! boolean_icon($requirement->required) !!}</td>
                    <td><input type="number" name="evaluations[{{ $requirement->id }}][score]" min="0" max="{{ $requirement->full_score }}" class="form-control" value="{{ $evaluation->getScore($requirement->id) }}"></td>
                    <td><textarea name="evaluations[{{ $requirement->id }}][remarks]" class="form-control" rows="5">{{ $evaluation->getRemarks($requirement->id) }}</textarea></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="panel-footer">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <textarea name="remarks" class="form-control" rows="3" placeholder="{{ trans('evaluations.attributes.remarks') }}"></textarea>
                </div>
                <div class="col-xs-12 col-md-2 col-md-offset-4">
                    <input type="submit" value="{{ trans('actions.save') }}" class="btn bg-blue-700 pull-right">
                </div>
            </div>
        </div>
    {!! Former::close() !!}
</div>