{!! Former::hidden('subscriber_type')->forceValue('App\Subscriber') !!}

{!! Former::select('subscriber_id')
    ->options(['' => trans('subscriptions.views.admin.form.select-subscriber')] + App\Vendor::options())
    ->label('subscriptions.views.admin.form.subscriber')
    ->required() !!}

{!! Former::select('package_id')
    ->options(['' => trans('subscriptions.views.admin.form.select-package')] + App\Package::options())
    ->label('subscriptions.views.admin.form.package')
    ->required() !!}

{!! Former::text('start_at')
    ->label('subscriptions.attributes.start_at')
    ->addClass('daterange-single')
    ->required() !!}
