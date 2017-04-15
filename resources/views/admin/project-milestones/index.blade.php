@extends('layouts.admin')

@section('page-title', trans('project-milestones.title'))

@section('header')
<div class="page-title">
	<h4>{{ trans('project-milestones.title') }}</h4>
</div>
<div class="heading-elements">
	<div class="heading-btn-group">
        <a href="{{ route('admin.projects.show', $project->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class=" icon-undo2"></i> <span>{{ trans('actions.back') }}</span>
        </a>
	</div>
</div>
@endsection

@section('content')
    <div id="project-milestones">
        <div class="panel panel-flat">
            <div class="panel-body">
                <span><small>{{ $project->number }}</small> <br> {{ $project->name }}</span>
            </div>
        </div>
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="gantt-container">
                            <svg id="gantt"></svg>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                                <button type="button" class="btn btn-default btn-block btnMode"
                                        @click="view_mode('Half Day')">Half Day
                                </button>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-default btn-block btnMode"
                                        @click="view_mode('Day')"> Day
                                </button>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-default btn-block btnMode"
                                        @click="view_mode('Week')">Week
                                </button>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-default btn-block btnMode"
                                        @click="view_mode('Month')">Month
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/pages/project-milestones/index.js') }}" type="application/javascript"></script>
@endsection