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
            @foreach($evaluation->notice->submissionRequirements()->type($evaluation->type_id)->whereStatus('active')->orderBy('sequence')->get() as $requirement)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $requirement->title }}</td>
                    <td></td>
                    <td></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>