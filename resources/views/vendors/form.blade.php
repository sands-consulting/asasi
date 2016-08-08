<fieldset>
    <legend class="text-semibold">
        <i class="icon-file-text2 position-left"></i>
        Vendor Information
        <a class="control-arrow" data-toggle="collapse" data-target="#personal-info">
            <i class="icon-circle-down2"></i>
        </a>
    </legend>

    <div class="collapse in" id="personal-info">
        <div class="row">
            <div class="col-sm-6"> 
                {!! Former::text('name')
                ->label('vendors.attributes.name')
                ->placeholder('Eg: Vendor Sdn. Bhd.') !!}
            </div>
            <div class="col-sm-3"> 
                {!! Former::text('registration_number')
                ->label('vendors.attributes.registration_number')
                ->placeholder('Eg: M1234567') !!}
            </div>
            <div class="col-sm-3"> 
                {!! Former::select('type_id')
                ->options(App\VendorType::options())
                ->label('vendors.attributes.type_id')
                ->addClass('select-search') !!}
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6"> 
                {!! Former::text('tax_1_number')
                ->label('vendors.attributes.tax_1_number') !!}
            </div>
            <div class="col-sm-6"> 
                {!! Former::text('tax_2_number')
                ->label('vendors.attributes.tax_2_number') !!}
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                {!! Former::text('contact_telephone')
                ->label('vendors.attributes.contact_telephone') !!}
            </div>
            <div class="col-sm-6">
                {!! Former::text('contact_fax')
                ->label('vendors.attributes.contact_fax') !!}
            </div>
            <div class="col-sm-6">
                {!! Former::text('contact_email')
                ->label('vendors.attributes.contact_email') !!}
            </div>
            <div class="col-sm-6">
                {!! Former::text('contact_website')
                ->label('vendors.attributes.contact_website')
                ->prepend('http://') !!}
            </div>
        </div>
    </div>
</fieldset>
<fieldset>
    <legend class="text-semibold">
        <i class="icon-location3 position-left"></i>
        Address
        <a class="control-arrow" data-toggle="collapse" data-target="#address">
            <i class="icon-circle-down2"></i>
        </a>
    </legend>
    <div class="collapse in" id="address">
        {!! Former::text('address_1')
        ->label('vendors.attributes.address_1')
        ->placeholder('Eg: Lot 10, Jalan A2') !!}

        {!! Former::text('address_2')
        ->label('vendors.attributes.address_2')
        ->placeholder('Eg: Taman A') !!}

        <div class="row">
            <div class="col-sm-6">
                {!! Former::select('address_city_id')
                ->label('vendors.attributes.address_city_id')
                ->options(App\Place::cityOptions()) !!}
            </div>
            <div class="col-sm-6">
                {!! Former::text('address_postcode')
                ->label('vendors.attributes.address_postcode') 
                ->maxLength(5) !!}
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                {!! Former::select('address_state_id')
                ->label('vendors.attributes.address_state_id')
                ->options(App\Place::stateOptions()) !!}
            </div>
            <div class="col-sm-6">
                {!! Former::select('address_country_id')
                ->label('vendors.attributes.address_country_id') 
                ->options(App\Place::countryOptions()) !!}
            </div>
        </div>
    </div>
</fieldset>
<fieldset>
    <legend class="text-semibold">
        <i class="icon-address-book position-left"></i>
        Contacts
        <a class="control-arrow" data-toggle="collapse" data-target="#contacts">
            <i class="icon-circle-down2"></i>
        </a>
    </legend>
    <div class="collapse in" id="contacts">
        <div class="row">
            <div class="col-sm-1">
                {!! Former::text('contact_person_designation')
                ->label('vendors.attributes.contact_person_designation') !!}
            </div>
            <div class="col-sm-4">
                {!! Former::text('contact_person_name')
                ->label('vendors.attributes.contact_person_name') !!}
            </div>
            <div class="col-sm-4">
                {!! Former::text('contact_person_email')
                ->label('vendors.attributes.contact_person_email') !!}
            </div>
            <div class="col-sm-3">
                {!! Former::text('contact_person_telephone')
                ->label('vendors.attributes.contact_person_telephone') !!}
            </div>
        </div>
    </div>
</fieldset>
<fieldset>
    <legend class="text-semibold">
        <i class="icon-office position-left"></i>
        Add Company Details
        <a class="control-arrow" data-toggle="collapse" data-target="#company-details">
            <i class="icon-circle-down2"></i>
        </a>
    </legend>

    <div class="collapse in" id="company-details">
        <div class="row">
            <div class="col-sm-4">
                {!! Former::text('capital_currency')
                ->label('vendors.attributes.capital_currency') !!}
            </div>
            <div class="col-sm-4">
                {!! Former::text('capital_authorized')
                ->label('vendors.attributes.capital_authorized') !!}
            </div>
            <div class="col-sm-4">
                {!! Former::text('capital_paid_up')
                ->label('vendors.attributes.capital_paid_up') !!}
            </div>
        </div>
    </div>
</fieldset>


