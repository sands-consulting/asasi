<div role="tabpanel" class="tab-pane" id="tab-notice-evaluation-requirements">
    @foreach(App\EvaluationType::active()->get() as $type)

    <div class="panel panel-default">
        <div class="panel-heading">
            <h6 class="panel-title">{{ $type->name }}</h6>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th>{{ trans('notices.attributes.evaluation-requirements.title') }}</th>
                    <th class="col-xs-1 text-right">{{ trans('notices.attributes.evaluation-requirements.full_score') }}</th>
                    <th class="col-xs-1 text-right">{{ trans('notices.attributes.evaluation-requirements.required') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($notice->evaluationRequirements()->whereTypeId($type->id)->orderBy('sequence')->get() as $requirement)
                    <tr>
                        <td width="5%">{{ $requirement->sequence }}</td>
                        <td>{{ $requirement->title }}</td>
                        <td class="text-right">{{ $requirement->full_score }}</td>
                        <td class="text-right">{!! boolean_icon($requirement->required) !!}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">{{ trans('notices.views.admin.show.evaluation-requirements.empty') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @endforeach
</div>