@if($subscription->status == 'active')
<span class="label label-success">
@elseif($subscription->status == 'suspended')
<span class="label label-danger">
@else
<span class="label label-default">
@endif

{{ trans('statuses.' . $subscription->status) }}

</span>