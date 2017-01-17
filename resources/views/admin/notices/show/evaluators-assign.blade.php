@extends('admin.notices.show')

@section('show')
{!! Former::open(route('admin.evaluators.assigned', [$evaluator->id, $notice->id])) !!}
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">{{ trans('evaluators.views.create.title') }}</h5>
        </div>

        <div class="panel-body">
            <fieldset>
                <legend class="text-semibold"> <i class="icon-clipboard3"></i> Submission List</legend>
                <div class="row">
                    @foreach ($notice->submissions as $submission)
                        @php
                            $evaluator_submission = $evaluator->submissions()->wherePivot('submission_id', $submission->id)->first();
                            $checked = $evaluator_submission ? true: false;
                        @endphp
                        <div class="col-sm-3">
                            {!! Former::checkboxes('submission_id[]')
                                ->checkboxes([ 
                                    "Submission " . $submission->id => [
                                        'name' => 'submission_id[]', 
                                        'value' => $submission->id,
                                        'checked' => $checked
                                    ]
                                ])
                                ->label(false) !!}
                        </div>
                    @endforeach
                </div>
            </fieldset>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-sm-12 text-right">
                    <button type="submit" class="btn bg-blue-400">Assign</button>
                </div>
            </div>
        </div>
    </div>
{!! Former::close() !!}
@endsection