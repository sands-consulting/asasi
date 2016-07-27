@if($place->status == 'active')
<span class="label label-success">
@elseif($place->status == 'inactive')
<span class="label label-warning">
@else
<span class="label label-default">
@endif

{{ trans('statuses.' . $place->status) }}

</span>