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
<div class="panel panel-flat">
    <div class="panel-body">
        <span><small>{{ $project->number }}</small> <br> {{ $project->name }}</span>
    </div> 
</div>
<div class="panel panel-flat">
    <div id="gantt_here" style='width:100%; min-height:500px;'></div>
    <div class="panel-body">
        <div class="text-right">
            <button class="btn btn-default" onclick="exportGantt('pdf')"><i class="icon-file-pdf"></i>  Export to PDF</button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<link rel="stylesheet" href="/assets/dhtmlxGantt/codebase/dhtmlxgantt.css" type="text/css" media="screen">
<script src="/assets/dhtmlxGantt/codebase/dhtmlxgantt.js" type="text/javascript" charset="utf-8"></script>
<script src="http://export.dhtmlx.com/gantt/api.js"></script> 

<script type="text/javascript">
    var project_id = {{ $project->id }};

    gantt.config.xml_date = "%Y-%m-%d %H:%i:%s";
    gantt.config.step = 1;
    gantt.config.scale_unit= "day";
    gantt.config.order_branch = true;
    gantt.init("gantt_here");
    gantt.load("./milestones/gantt_data", "xml");

    gantt.attachEvent("onBeforeTaskAdd", function (id, task) {
        task.project_id = project_id;
    });

    var dp = new dataProcessor("./milestones/gantt_data");
    dp.init(gantt);

    function exportGantt(mode){
        if (mode == "png")
            gantt.exportToPNG();
        else if (mode == "pdf")
            gantt.exportToPDF();
    }
</script>
@endsection