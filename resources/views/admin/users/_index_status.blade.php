@if($user->status == 'active')
<span class="label label-success">
@elseif($user->status == 'suspended')
<span class="label label-danger">
@else
<span class="label label-default">
@endif

{{ trans('statuses.' . $user->status) }}

</span>