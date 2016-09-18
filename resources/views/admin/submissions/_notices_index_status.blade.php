@if($notice->status == 'active')
<span class="label label-success">
@elseif($notice->status == 'inactive')
<span class="label label-danger">
@else
<span class="label label-default">
@endif

{{ trans('statuses.' . $notice->status) }}

</span>