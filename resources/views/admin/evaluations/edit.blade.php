@extends('layouts.admin')

@section('page-title', trans('evaluations.vendors'))

@section('header')
<div class="page-title">
    <h4>{{ trans('evaluations.title') }}</h4>
</div>
<div class="heading-elements">
    <a href="{{ route('admin.evaluations.submission', $notice->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
        <i class=" icon-undo2"></i> <span>{{ trans('actions.back') }}</span>
    </a>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">Evaluations</h6>
            </div>
            {!! Former::open(route('admin.evaluations.update', [$notice->id, $submission->id]))->method('PUT') !!}
            <table class="table table-bordered table-striped table-condensed">
                <thead>
                    <tr>
                        <th width="80px">#</th>
                        <th>Title</th>
                        <th width="250px">Score</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach ($requirements as $requirement)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $requirement->title }}</td>
                            <td>
                                {!! Former::number('scores['. $requirement->id .']')
                                    ->label(false)
                                    ->append('/ ' . $requirement->full_score)
                                    ->addClass('text-center')
                                    ->min(0)
                                    ->max($requirement->full_score)
                                    ->value($requirement->score)
                                    ->required() !!}</td>
                        </tr>
                        <?php $i++; ?>
                    @endforeach
                </tbody>
            </table>
            <div class="panel-footer">
                <div class="text-center">
                    <button type="submit" class="btn btn-primary bg-blue-400 pl-20 pr-20">{{ trans('actions.save') }}</button>
                </div>
            </div>
            {!! Former::close() !!}
        </div>
    </div>
</div>
@endsection
