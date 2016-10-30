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
<ul class="breadcrumb-elements">
    @if(Auth::user()->hasPermission('project:logs'))
    <li>
        <a href="{{ route('admin.projects.logs', $project->id) }}" class="legitRipple">
            <i class="icon-database-time2"></i> {{ trans('user-logs.title') }}
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
<div class="row row-eq-height">
    <div class="col-sm-8">
        <div class="panel panel-flat  eq-element">
            <div class="panel-body">
                <div class="row mb-20">
                    <div class="col-sm-10">
                        <div class="text-muted">{{ $project->number }}</div>
                        <a href="{{ route('admin.projects.show', $project->id) }}">{{ $project->name }}</a>
                    </div>
                    <div class="col-sm-2 text-center">
                        <span class="label label-warning label-rounded text-thin">{{ $project->status }}</span>
                    </div>
                </div>
                <div class="row mb-20">
                    <div class="col-md-4">
                        <div class="well bg-white">
                            <div class="text-center">
                                Approved Allocation
                            </div>
                            <div class="text-center text-size-xlarge text-grey">
                                RM {{ $project->cost }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="well bg-white">
                            <div class="text-center">
                                Disbursement
                            </div>
                            <div class="text-center text-size-xlarge text-orange">
                                RM 20,000
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="well bg-white">
                            <div class="text-center">
                                Balance
                            </div>
                            <div class="text-center text-size-xlarge text-grey-300">
                                RM 1000,000
                            </div>
                        </div>
                    </div>                  
                </div>

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
                            <div class="form-control-static">{{ $project->cost }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="text-muted">Company Type</label>
                            <div class="form-control-static">{{ $project->vendor->type->incorporation_authority }} - {{ $project->vendor->type->incorporation_type }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-flat  eq-element">
            <div class="panel-heading">
                <h6 class="panel-title">Project Milestone<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
            </div>
            <div class="panel-body eq-element">
                
                <div class="timeline timeline-left">
                    <div class="timeline-container">
                        
                        <!-- Milstone -->
                        @foreach ($project->milestones()->latest(5) as $milestone)
                        <div class="timeline-row">
                            <div class="timeline-icon">
                                <a href="#">{!! Gravatar::image(Auth::user()->email, Auth::user()->name, ['width' => 34, 'height' => 34]) !!}</a>
                            </div>

                            <div class="panel panel-flat timeline-content">
                                <div class="panel-heading">
                                    <h6 class="panel-title">{{ $milestone->name }}<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
                                    <div class="heading-elements">
                                        <span class="heading-text"><i class="icon-history position-left text-success"></i> Updated {{ $milestone->updated_at->diffForHumans() }}</span>

                                        <ul class="icons-list">
                                            <li><a data-action="reload"></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">
                                    {{ str_limit($milestone->description, 45) }}
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <!-- /Milestone -->

                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
