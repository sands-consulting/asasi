<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="panel-title">{{ trans('vendors.views.create.public.title') }}</h5>
            </div>
        </div>
    </div>

    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12">
                <fieldset>
                    <legend class="text-semibold">
                        <i class="icon-user position-left"></i>
                        Create Account
                        <a class="control-arrow" data-toggle="collapse" data-target="#account">
                            <i class="icon-circle-down2"></i>
                        </a>
                    </legend>

                    <div class="collapse in" id="account">
                        <div class="row">
                            <div class="col-sm-4">
                                {!! Former::email('contact_email')
                                    ->label('vendors.attributes.contact_email')
                                    ->placeholder('Eg: vendor@example.com') !!}
                            </div>
                            <div class="col-sm-4">
                                {!! Former::text('password')
                                    ->label('auth.password') !!}
                            </div>
                            <div class="col-sm-4">
                                {!! Former::text('password_confirmation')
                                    ->label('auth.confirm_password') !!}
                            </div>
                        </div>
                    </div>
                </fieldset>
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
                            <div class="col-sm-7"> 
                                {!! Former::text('name')
                                    ->label('vendors.attributes.name')
                                    ->placeholder('Eg: Ahmad Bin Abu') !!}
                            </div>
                            <div class="col-sm-5"> 
                                {!! Former::text('registration_number')
                                    ->label('vendors.attributes.registration_number')
                                    ->placeholder('Eg: M1234567') !!}
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
                                {!! Former::text('address_city')
                                    ->label('vendors.attributes.address_city_id')
                                    ->placeholder('Eg: Kuala Lumpur') !!}
                            </div>
                            <div class="col-sm-6">
                                {!! Former::text('address_postcode')
                                    ->label('vendors.attributes.address_postcode')
                                    ->placeholder('Eg: 55100') !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                {!! Former::text('address_state_id')
                                    ->label('vendors.attributes.address_state_id')
                                    ->placeholder('Eg: Selangor Darul Ehsan') !!}
                            </div>
                            <div class="col-sm-6">
                                {!! Former::text('address_country_id')
                                    ->label('vendors.attributes.address_country_id')
                                    ->placeholder('Eg: Malaysia') !!}
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
                            <div class="col-sm-6">
                                {!! Former::text('contact_name')
                                    ->label('vendors.attributes.contact_name') !!}
                            </div>
                            <div class="col-sm-6">
                                {!! Former::text('contact_telephone')
                                    ->label('vendors.attributes.contact_telephone') !!}
                            </div>
                            <div class="col-sm-6">
                                {!! Former::text('contact_fax')
                                    ->label('vendors.attributes.contact_fax') !!}
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
                
                
                <div class="text-right">
                    <button type="submit" class="btn btn-primary legitRipple">Submit form <i class="icon-arrow-right14 position-right"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>