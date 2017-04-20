<div class="tab-pane active" id="tab-evaluation">
    <div class="panel panel-flat panel-form">
        <table class="table table-vtop">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('evaluations.attributes.requirement') }}</th>
                    <th class="col-xs-2">{{ trans('evaluations.attributes.score') }}</th>
                    <th class="col-xs-3">{{ trans('evaluations.attributes.remarks') }}</th>
                </tr>
            </thead>
            <tbody>
            @foreach($evaluation->notice->evaluationRequirements()->type($evaluation->type_id)->whereStatus('active')->orderBy('sequence')->get() as $requirement)
                <tr class="border-left-danger">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $requirement->title }}</td>
                    <td>{{ $evaluation->getScore($requirement->id) }}</td>
                    <td>{!! nl2br($evaluation->getRemarks($requirement->id)) !!}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @if($evaluation->remarks)
        <div class="panel-footer">
            {!! nl2br($evaluation->remarks) !!}
        </div>
        @endif
    </div>
</div>