<fieldset>
    <legend class="text-semibold">Vendor Details</legend>
    {!! Former::text('name')
        ->label('vendors.attributes.name')
        ->required() !!}

    {!! Former::text('registration_number')
        ->label('vendors.attributes.registration_number')
        ->required() !!}

    {!! Former::text('tax_1_number')
        ->label('vendors.attributes.tax_1_number')
        ->required() !!}  

    {!! Former::text('tax_2_number')
        ->label('vendors.attributes.tax_2_number')
        ->required() !!}  
</fieldset>

<fieldset>
    <legend class="text-semibold">Address</legend>
    {!! Former::text('address_1')
        ->label('vendors.attributes.address_1')
        ->required() !!}

    {!! Former::text('address_2')
        ->label('vendors.attributes.address_2')
        ->required() !!}

    {!! Former::text('address_city_id')
        ->label('vendors.attributes.address_city_id') !!}

    {!! Former::text('address_state_id')
        ->label('vendors.attributes.address_state_id') !!}

    {!! Former::text('address_country_id')
        ->label('vendors.attributes.address_country_id') !!}
</fieldset>

<fieldset>
    <legend class="text-semibold">Contacts</legend>
    {!! Former::text('contact_name')
        ->label('vendors.attributes.contact_name')
        ->required() !!}

    {!! Former::text('contact_telephone')
        ->label('vendors.attributes.contact_telephone')
        ->required() !!}

    {!! Former::text('contact_fax')
        ->label('vendors.attributes.contact_fax') !!}

    {!! Former::text('contact_email')
        ->label('vendors.attributes.contact_email') !!}

    {!! Former::text('contact_website')
        ->label('vendors.attributes.contact_website') !!}
</fieldset>

<fieldset>
    <legend class="text-semibold">Company Details</legend>
    {!! Former::text('capital_currency')
        ->label('vendors.attributes.capital_currency')
        ->required() !!}
    
    {!! Former::text('capital_authorized')
        ->label('vendors.attributes.capital_authorized') !!}

    {!! Former::text('capital_paid_up')
        ->label('vendors.attributes.capital_paid_up')
        ->required() !!}
    
</fieldset>
<div class="form-group">
    <div class="col-lg-10 col-sm-8 col-lg-offset-2 col-sm-offset-4">
        {!! Former::submit(trans('actions.save'))->addClass('bg-blue')->data_confirm(trans('app.confirmation')) !!}
        {!! link_to_route('admin.vendors.show', trans('actions.cancel'), $vendor->id, ['class' => 'btn btn-default']) !!}
    </div>
</div>