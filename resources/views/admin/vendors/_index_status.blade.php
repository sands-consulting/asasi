@if($vendor->status == 'active')
<span class="label label-success">
@elseif($vendor->status == 'suspended')
<span class="label label-danger">
@else
<span class="label label-default">
@endif

{{ trans('statuses.' . $vendor->status) }}

</span>