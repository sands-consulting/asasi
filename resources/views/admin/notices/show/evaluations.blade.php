<div role="tabpanel" class="tab-pane" id="tab-notice-evaluations">
    <div class="panel panel-default">
        <table class="table table-condensed table-bordered">
            <thead>
                <tr>
                    <th width="50">#</th>
                    <th width="100">&nbsp;</th>
                    <th>Vendor</th>
                    @foreach($notice->evaluationSettings()->with('type')->get() as $setting)<th class="text-right">{{ $setting->type->name }}</th>@endforeach
                    <th width="200" class="text-right">{{ trans('evaluations.attributes.overall_percentage') }}</th>
                </tr>
            </thead>
            <tbody>
            @foreach($notice->submissions()->whereStatus('submitted')->orderBy('overall_percentage', 'desc')->get() as $submission)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="text-right">@if($submission->label)<span class="label bg-blue-700">{{ $submission->label }}</span>@endif</td>
                    <td>{{ $submission->vendor->name }}</td>
                    @foreach($notice->evaluationSettings()->with('type')->get() as $setting)
                    <td class="text-right">
                        {{ $submission->averagePercentage($setting->type_id) }} %<br>
                        <small>{{ $submission->averageScore($setting->type_id) }} / {{ $submission->totalScore($setting->type_id) }}</small>
                    </td>
                    @endforeach
                    <td class="text-right">{{ $submission->overall_percentage }} %</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <hr>

    @foreach($notice->submissions()->whereStatus('submitted')->orderBy('label')->orderBy('submitted_at')->get() as $submission)
    <div class="panel panel-default panel-form">
        <div class="panel-heading">
            <h4 class="panel-title">
                @if($submission->label)<span class="label bg-blue-700">{{ $submission->label }}</span>@endif
                
            </h4>
        </div>
        <table class="table">
            <tr>
                <th class="col-xs-3">{{ trans('submissions.attributes.number') }}</td>
                <td class="col-xs-3">{{ $submission->number }}</td>
                <th class="col-xs-3">{{ trans('submissions.attributes.price') }}</th>
                <td class="col-xs-3">{{ setting('currency') }} {{ $submission->price }}</td>
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
