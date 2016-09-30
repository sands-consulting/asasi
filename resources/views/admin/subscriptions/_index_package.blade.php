@if($subscription->label_color != '')
<span class="label bg-{{ $subscription->label_color }}">
@else
<span class="label label-default">
@endif

{{ $subscription->package_name }}

</span>