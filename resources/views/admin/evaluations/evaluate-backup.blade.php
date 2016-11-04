@extends('layouts.admin')

@section('header')
<div class="page-title">
    <h4>{{ trans('submissions.views.evaluate.title', ['submission' => trans('submissions.types.' . $submission->type) ]) }}</h4>
</div>
@endsection

@section('content')

<div class="panel panel-flat">
    <div class="panel-body">
        <fieldset>
            <legend class="text-semibold">
                <i class="icon-file-text2 position-left"></i>
                Submission Info
            </legend>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label"><strong>{{ trans('notices.attributes.number') }}</strong>:</label>
                        <div class="form-control-static">{{ $submission->notice->number }}</div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label"><strong>{{ trans('notices.attributes.name') }}</strong>:</label>
                        <div class="form-control-static">{{ $submission->notice->name }}</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label"><strong>{{ trans('vendors.attributes.name') }}</strong>:</label>
                        <div class="form-control-static">****</div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label"><strong>{{ trans('submissions.attributes.created_at') }}</strong>:</label>
                        <div class="form-control-static">{{ $submission->created_at->getShort() }}</div>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
</div>
<div class="panel panel-flat">
    <table class="table">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th>Title</th>
                <th>Value</th>
                <th>Remark</th>
                <th width="15%">Rating</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @foreach($submissionDetails as $detail)
            <tr id="row-{{ $detail->id }}">
                <td>{{ $i }}</td>
                <td>
                    {{ $detail->requirement->title }}
                </td>
                <td>
                    <span class="text-blue"> 
                        @if ($detail->requirement->type == 'check')
                            {{ $detail->value == 1 ? 'Yes' : 'No' }}
                        @elseif ($detail->requirement->type == 'file')
                            <a href="{{ $detail->files()->first()->url }}" target="_blank" class="btn btn-success btn-xs">View File</a>
                        @endif
                    </span>
                </td>
                <td>
                    <a href="#" 
                        class="myeditable"
                        data-type="textarea"
                        data-onblur="submit"
                        @if ($detail->evaluation) 
                            data-pk="{{ $detail->evaluation->id }}" 
                            data-name="remark"
                        @else    
                            data-name="submission_evaluation[{{ $detail->id }}][remark]"
                        @endif 
                        data-url="{{ route('api.evaluations.update') }}"
                    >{{ $detail->evaluation ? $detail->evaluation->remark : '' }}</a>
                </td>
                <td>
                    <a href="#" 
                        class="myeditable" 
                        data-type="select"
                        data-mode="inline"
                        data-showButtons="false"
                        data-onblur="submit"
                        data-source="[{value: '', text: 'Select'}, {value: 1, text: '1'}, {value: 2, text: '2'}, {value: 3, text: '3'}, {value: 4, text: '4'}, {value: 5, text: '5'}]"
                        @if ($detail->evaluation) 
                            data-pk="{{ $detail->evaluation->id }}"
                            data-value="{{ $detail->evaluation->rating }}"
                            data-name="rating"
                        @else
                            data-name="submission_evaluation[{{ $detail->id }}][rating]"
                        @endif
                        data-url="{{ route('api.evaluations.update') }}"
                        data-inputclass="no-minimum-width"
                    >{{ $detail->evaluation ? $detail->evaluation->rating : '' }}</a>
                </td>
            </tr>
                <?php $i++; ?>
            @endforeach
        </tbody>
    </table>
</div>

<div class="panel panel-flat">
    <div class="panel-body">
        <a href="{{ route('admin.evaluations.vendors', $submission->notice->id) }}" class="btn btn-default">Back</a>
        <button id="evaluations-btn-save" class="btn btn-primary pull-right" data-url="{{ route('api.evaluations.store') }}">Save</button>
    </div>
</div>
@endsection
