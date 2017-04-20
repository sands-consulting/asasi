@if($evaluation->status == 'active')
<span class="label label-success">
@elseif($evaluation->status == 'pending')
<span class="label label-danger">
@else
<span class="label label-default">
@endif

{{ trans('statuses.' . $evaluation->status) }}

</span>