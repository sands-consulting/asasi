<div class="row"> 
    <div class="col-sm-6"> 
        {!! Former::select('vendor_id')
            ->options(App\Vendor::options())
            ->label('subscriptions.attributes.vendor_id')
            ->required() !!}
    </div>
    <div class="col-sm-6"> 
        {!! Former::select('package_id')
            ->options(App\Package::options())
            ->label('subscriptions.attributes.package_id')
            ->required() !!}
    </div>
    <div class="col-sm-6">
        {!! Former::text('started_at')
            ->label('subscriptions.attributes.started_at')
            ->addClass('daterange-single')
            ->required() !!}
    </div>
    <div class="col-sm-6"> 
        {!! Former::text('expired_at')
            ->label('subscriptions.attributes.expired_at')
            ->addClass('daterange-single')
            ->required() !!}
    </div>
</div>
