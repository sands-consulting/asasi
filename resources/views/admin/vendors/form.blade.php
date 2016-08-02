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

    {!! Former::select('address_city_id')
        ->options(App\Place::cityOptions())
        ->label('vendors.attributes.address_city_id') !!}

    {!! Former::select('address_state_id')
        ->options(App\Place::stateOptions())
        ->label('vendors.attributes.address_state_id') !!}

    {!! Former::select('address_country_id')
        ->options(App\Place::countryOptions())
        ->label('vendors.attributes.address_country_id') !!}
</fieldset>

<fieldset>
    <legend class="text-semibold">Contacts</legend>
    {!! Former::text('contact_person_name')
        ->label('vendors.attributes.contact_person_name')
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
