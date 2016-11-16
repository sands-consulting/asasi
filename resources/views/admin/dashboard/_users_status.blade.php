@if($user->status == 'active')
<span class="text-success">
@elseif($user->status == 'suspended')
<span class="text-danger">
@else
<span class="text-default">
@endif

{{ trans('statuses.' . $user->status) }}

</span>