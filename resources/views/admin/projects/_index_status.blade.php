@if($project->project_status == 'completed')
<span class="label label-rounded label-success">
@elseif($project->project_status == 'ongoing')
<span class="label label-rounded label-warning">
@else
<span class="label label-rounded label-default">
@endif

{{ trans('statuses.' . $project->project_status) }}

</span>