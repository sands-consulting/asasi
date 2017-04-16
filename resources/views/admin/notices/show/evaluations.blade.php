<div role="tabpanel" class="tab-pane" id="tab-notice-evaluations">
    @foreach($notice->submissions()->whereStatus('completed')->orderBy('label')->orderBy('submitted_at')->get() as $submission)
    <div class="panel panel-default panel-form">
        <div class="panel-heading">
            <h4 class="panel-title">
                @if($submission->label)<span class="label bg-blue-700">{{ $submission->label }}</span>@endif
                {{ $submission->vendor->name }}
            </h4>
        </div>
        <table class="table">
            <tr>
                <td class="col-xs-3">{{ trans('submissions.attributes.number') }}</td>
                <td>{{ $submission->number }}</td>
            </tr>
            <tr>
                <td>{{ trans('submissions.attributes.price') }}</td>
                <td>{{ setting('currency') }} {{ $submission->price }}</td>
            </tr>
        </table>
        <table class="table">
            @foreach(App\EvaluationType::active()->get() as $type)
            <thead>
                <tr class="bg-blue-700">
                    <th colspan="4">{{ $type->name }}</th>
                    <th class="col-xs-2 text-right">{{ trans('submissions.attributes.avg_score') }}: {{ $submission->averageScore($type->id) }}</th>
                </tr>
                <tr>
                    <th width="50">#</th>
                    <th>{{ trans('evaluations.attributes.evaluator') }}</th>
                    <th class="col-xs-1">{{ trans('evaluations.attributes.status') }}</th>
                    <th class="col-xs-1">{{ trans('evaluations.attributes.score') }}</th>
                    <th width="20">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @forelse($submission->evaluations()->whereTypeId($type->id)->whereNotIn('status', ['cancelled', 'rejected'])->get() as $evaluation)
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <td>{{ $evaluation->user->name }}</td>
                    <td><span class="label label-default">{{ trans('statuses.' . $evaluation->status) }}</span></td>
                    <td>{{ (int) $evaluation->score }}</td>
                    <td class="text-right"><a href="{{ route('admin.evaluations.show', $evaluation->id) }}" class="btn btn-xs bg-blue-700">{{ trans('actions.view') }}</a></td>
                </tr>
                @empty
                <tr>
                    <td class="text-center" colspan="5">{{ trans('notices.views.admin.show.evaluations.empty') }}</td>
                </tr>
                @endforelse
            </tbody>
            @endforeach
        </table>
    </div>
    @endforeach
</div>
