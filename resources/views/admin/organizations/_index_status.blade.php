@if($organization->status == 'active')
<span class="label label-success">
@elseif($organization->status == 'inactive')
<span class="label label-warning">
@else
<span class="label label-default">
@endif

{{ trans('statuses.' . $organization->status) }}

</span>