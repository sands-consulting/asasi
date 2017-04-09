<div class="panel panel-default">
    <div class="panel-body">
        <div class="pull-left text-thin">
        @if($vendor->type)<strong>{{ $vendor->type->label }}</strong> @endif{{ $vendor->registration_number }}</div>
        <div class="pull-right">
        	@if($vendor->active_subscription)
        	<span class="label bg-blue-700">{{ trans('subscriptions.attributes.end_at') }}: {{ $vendor->active_subscription->end_at->format('d/m/Y') }}</span>
			@else
			<span class="label label-default">{{ trans('subscriptions.notices.no-subscription') }}</span>
			@endif
            @include('admin.vendors.index.status')
        </div>
        <div class="clearfix"></div>
        <h4 class="text-thin pull-left">{{ $vendor->name }}</h4>
    </div>
</div>
