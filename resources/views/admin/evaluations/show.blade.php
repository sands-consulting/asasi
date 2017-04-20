@extends('layouts.window-plain')

@section('content')
<div class="col-xs-12">
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-8">
                        <div class="text-muted">{{ $notice->number }}</div>
                        <a href="{{ route('admin.notices.show', $notice->id) }}">{{ $notice->name }}</a>
                    </div>
                    <div class="box">
                        <div class="col-xs-2 text-center text-muted">
                            <div class="text-size-mini">Notice Type</div>
                            <div>{{ $notice->type ? $notice->type->name : 'N/A' }}</div>
                        </div>
                        <div class="col-xs-2 text-center text-muted">
                            <div class="text-size-mini">Evaluation Type</div>
                            <div>{{ $notice->type ? $notice->type->name : 'N/A' }}</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="text-muted">{{ !empty($notice->description) ? nl2br($notice->description) : 'N/A' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">Evaluations</h6>
            </div>
            <div class="panel-body">
                <?php $i = 1 ?>
                @foreach ($requirements as $requirement)
                    <div class="row mb-5 box row-eq-height">
                        <div class="col-xs-1 text-center eq-element valign-middle">{{ $i }}</div>
                        <div class="col-xs-2 eq-element">
                            {!! $requirement->mandatory ? '<span class="text-success">Mandatory</span>': '<span class="text-danger">Not Mandatory</span>' !!}</div>
                        <div class="col-xs-7 eq-element">{{ $requirement->title }}</div>
                        <div class="col-xs-2 eq-element greyed" style="display:inline-flex">
                            <div style="margin: auto;">
                                {{ $requirement->score }} / {{ $requirement->full_score }}
                            </div>
                        </div>
                    </div>
                    <?php $i++ ?>
                @endforeach
            </div>
            <div class="panel-footer">
                <div class="text-right">
                    <button type="button" class="btn btn-default">
                        <i class="icon-printer"></i> {{ trans('actions.print') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection