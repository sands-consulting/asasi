<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">{{ $evaluation->notice->name }}</h4>
    </div>

    <table class="table table-bordered table-condensed">
        <tr>
            <th class="col-xs-2">{{ trans('evaluations.attributes.notice_number') }}</th>
            <td class="col-xs-2">{{ $evaluation->notice->number }}</td>
            <th class="col-xs-2">{{ trans('evaluations.attributes.notice_type') }}</th>
            <td class="col-xs-2">{{ $evaluation->notice ? $evaluation->notice->type->name : blank_icon(nil) }}</td>
            <th class="col-xs-2">{{ trans('evaluations.attributes.organization') }}</th>
            <td class="col-xs-2">{{ $evaluation->notice->organization->name }}</td>
        </tr>
        <tr>
            <th class="col-xs-2">{{ trans('evaluations.attributes.submission') }}</th>
            <td class="col-xs-2">{{ $evaluation->submission->number }}</td>
            <th class="col-xs-2">{{ trans('evaluations.attributes.submitted_at') }}</th>
            <td class="col-xs-2">{{ $evaluation->submission->submitted_at->format('d/m/Y H:i:s') }}</td>
            <th class="col-xs-2">{{ trans('evaluations.attributes.type') }}</th>
            <td class="col-xs-2">{{ $evaluation->type ? $evaluation->type->name : blank_icon(nil) }}</td>
        </tr>
    </table>
</div>