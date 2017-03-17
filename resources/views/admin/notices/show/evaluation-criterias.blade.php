<div role="tabpanel" class="tab-pane" id="tab-notice-evaluation-criterias">
    @foreach(App\EvaluationType::active()->get() as $type)

    <div class="panel panel-default">
        <div class="panel-heading">
            <h6 class="panel-title">{{ $type->name }}</h6>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th>{{ trans('notices.views.admin.evaluation-criterias.table.title') }}</th>
                    <th class="col-xs-2 text-right">{{ trans('notices.views.admin.evaluation-criterias.table.full-score') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($notice->evaluationRequirements()->whereTypeId($type->id)->orderBy('sequence')->get() as $requirement)
                    <tr class="{{ $requirement->required ? " danger" : "" }}">
                        <td width="5%">{{ $requirement->sequence }}</td>
                        <td>{{ $requirement->title }}</td>
                        <td class="text-right">{{ $requirement->full_score }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">{{ trans('notices.views.admin.evaluation-criterias.empty') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @endforeach
</div>