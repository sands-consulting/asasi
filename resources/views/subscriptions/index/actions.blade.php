@if($subscription->status != 'pending')
{!! link_to_route('subscriptions.show', trans('subscriptions.views.index.certificate'), $subscription->id, ['class' => 'btn btn-xs bg-blue-700']) !!}
@endif