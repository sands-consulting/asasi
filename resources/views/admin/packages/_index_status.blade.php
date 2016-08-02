@if($package->status == 'active')
<span class="label label-success">
@elseif($package->status == 'suspended')
<span class="label label-danger">
@else
<span class="label label-default">
@endif

{{ trans('statuses.' . $package->status) }}

</span>