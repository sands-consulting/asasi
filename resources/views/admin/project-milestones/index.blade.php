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
        <div class="panel panel-flat">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Milestones</th>
                        <th>Duration</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>%</th>
                        <th class="text-center">Ratings</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(task, index) in gantt.tasks">
                        <td v-text="index + 1"></td>
                        <td v-text="task.name"></td>
                        <td v-text="task.duration"></td>
                        <td v-text="task.start"></td>
                        <td v-text="task.end"></td>
                        <td v-text="task.progress"></td>
                        <td class="text-center">
                            <button 
                                class="btn btn-link btn-icon btn-xs"
                                style="padding: 5px"
                                v-if="task.progress == 100" 
                                v-for="n in 5" @click="updateRating(n, task.id)"
                            >
                                <span v-bind:class="getRated(n, task.ratings)"></span>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/pages/project-milestones/index.js') }}" type="application/javascript"></script>
@endsection