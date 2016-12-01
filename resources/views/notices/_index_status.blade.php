@if($notice->status == 'published')
<span class="label label-success">
@elseif($notice->status == 'cancelled')
<span class="label label-danger">
@else
<span class="label label-default">
@endif

{{ trans('statuses.' . $notice->status) }}

</span>