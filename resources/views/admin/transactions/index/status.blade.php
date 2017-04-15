@if($transaction->status == 'paid')
<span class="label label-success">
@elseif($transaction->status == 'pending')
<span class="label label-danger">
@elseif($transaction->status == 'pending-authorization')
<span class="label label-info">
@else
<span class="label label-default">
@endif

{{ trans('statuses.' . $transaction->status) }}

</span>