@if($vendor->status == 'active')
<span class="status label label-success">
@elseif($vendor->status == 'rejected')
<span class="status label label-danger">
@else
<span class="status label label-default">
@endif

{{ trans('statuses.' . $vendor->status) }}

</span>