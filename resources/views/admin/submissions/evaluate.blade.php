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
                <th width="20%">Value</th>
                <th width="15%">Rating</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @foreach($submissionDetails as $detail)
            <tr>
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
                    {!! Former::select() 
                        ->options([
                            '' => 'Select',
                            '1' => '1',
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5',

                        ]) !!}
                </td>
            </tr>
                <?php $i++; ?>
            @endforeach
        </tbody>
    </table>
</div>

<div class="panel panel-flat">
    <div class="panel-body">
        <a href="{{ route('admin.submissions.lists', $submission->notice->id) }}" class="btn btn-default">Back</a>
        <button class="btn btn-primary pull-right">Save</button>
    </div>
</div>
@endsection
