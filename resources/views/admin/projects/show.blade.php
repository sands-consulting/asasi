@extends('layouts.admin')

@section('page-title', implode(' | ', [
    $project->number,
    trans('projects.title')
]))

@section('header')
<div class="page-title">
    <h4>{{ link_to_route('admin.projects.index', trans('projects.title')) }} / <span class="text-semibold">{{ $project->number }}</span></h4>
</div>
<div class="heading-elements">
    <div class="heading-btn-group">
        @if(Auth::user()->hasPermission('project:update'))
        <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class="icon-pencil5"></i> <span>{{ trans('projects.buttons.edit') }}</span>
        </a>
        @endif

        @if(Auth::user()->id != $project->id && Auth::user()->hasPermission('project:delete'))
        <a href="{{ route('admin.projects.destroy', $project->id) }}" data-method="DELETE" class="btn btn-link btn-float text-size-small has-text text-danger legitRipple">
            <i class="icon-trash"></i> <span>{{ trans('actions.delete') }}</span>
        </a>
        @endif

        <a href="{{ route('admin.projects.index') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class=" icon-undo2"></i> <span>{{ trans('actions.back') }}</span>
        </a>
    </div>
</div>
@endsection

@section('secondary-header')
<ul class="breadcrumb breadcrumb-caret">
    <li><a href="{{ route('admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
    <li><a href="{{ route('admin.projects.index') }}">{{ trans('projects.title') }}</a></li>
    <li class="active">{{ $project->number }}</li>
</ul>
<ul class="breadcrumb-elements">
    @if(Auth::user()->hasPermission('project:histories'))
    <li>
        <a href="{{ route('admin.projects.histories', $project->id) }}" class="legitRipple">
            <i class="icon-database-time2"></i> {{ trans('user-histories.title') }}
        </a>
    </li>
    @endif

    @if(Auth::user()->hasPermission('project:revisions'))
    <li>
        <a href="{{ route('admin.projects.revisions', $project->id) }}" class="legitRipple">
            <i class="icon-database-edit2"></i> {{ trans('revisions.title') }}
        </a>
    </li>
    @endif
</ul>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="row mb-20">
                    <div class="col-sm-10">
                        <div class="text-muted">{{ $project->number }}</div>
                        <a href="{{ route('admin.projects.show', $project->id) }}">{{ $project->name }}</a>
                    </div>
                    <div class="col-sm-2 text-center">
                        @if($project->status == 'completed')
                        <span class="label label-rounded label-success">
                        @elseif($project->status == 'ongoing')
                        <span class="label label-rounded label-warning">
                        @else
                        <span class="label label-rounded label-default">
                        @endif

                        {{ trans('statuses.' . $project->status) }}

                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row row-eq-height">
    <div class="col-md-4">
        <div class="panel panel-flat eq-element">
            <div class="panel-heading">
                <p class="panel-title text-center"> Approved Allocation </p>
            </div>
            <div class="panel-body">
                <div class="text-center text-size-xlarge text-grey">
                    RM {{ $project->cost }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-flat eq-element">
            <div class="panel-heading">
                <p class="panel-title text-center"> Disbursement </p>
            </div>
            <div class="panel-body">
                <div class="text-center text-size-xlarge text-orange"> RM 20000.00</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-flat eq-element">
            <div class="panel-heading">
                <p class="panel-title text-center"> Balance </p>
            </div>
            <div class="panel-body">
                <div class="text-center text-size-xlarge text-grey-300"> RM 90000.00</div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-flat  eq-element">
            <div class="panel-body">
                <div class="row mb-20">
                    <div class="col-sm-12">
                        <fieldset>
                            <legend>Project Descriptions</legend>
                            <p class="text-grey-300">{{ $project->description }}</p>
                        </fieldset>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="text-muted">Company Name</label>
                            <div class="form-control-static">{{ $project->vendor->name }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="text-muted">Project Manager</label>
                            <div class="form-control-static">
                                <ul>
                                    @foreach($project->managers() as $manager)
                                        <li>
                                            <img src="{{ Gravatar::src($manager->email, 30) }}" class="img-circle" alt="{{ $manager->name }}">
                                            <span class="p-10 text-size-small">{{ $manager->name }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="text-muted">Company Reg. No.</label>
                            <div class="form-control-static">{{ $project->vendor->registration_number }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="text-muted">Proposed Project Cost</label>
                            <div class="form-control-static">{{ 'RM' }} {{ $project->cost }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="text-muted">Company Type</label>
                            <div class="form-control-static">{{ $project->vendor->type->incorporation_authority or null }}
                                - {{ $project->vendor->type->incorporation_type or null }}</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="text-muted">Project Gantt</label>
                        <div class="form-control-static">
                            <a href="{{ route('admin.projects.milestones.index', [$project->id]) }}"><i
                                        class="icon-graph"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
