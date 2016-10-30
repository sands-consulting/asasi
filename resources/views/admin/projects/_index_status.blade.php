@if($allocation->status == 'active')
<span class="label label-success">
@elseif($allocation->status == 'inactive')
<span class="label label-danger">
@else
<span class="label label-default">
@endif

{{ trans('statuses.' . $allocation->status) }}

</span>