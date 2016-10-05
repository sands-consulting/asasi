<div class="tabbable">
    <div class="row">
        <div class="col-sm-1">
            <ul class="nav nav-pills nav-stacked nav-primary">
                <li class="active text-center">
                    <a href="#vendor-details" data-toggle="tab" class="legitRipple">
                        <i class="icon-office"></i>
                        <span class="visible-xs-inline-block position-right">Vendors</span>
                    </a>
                </li>
                <li class="text-center">
                    <a href="#vendor-contacts" data-toggle="tab" class="legitRipple">
                        <i class="icon-phone"></i>
                        <span class="visible-xs-inline-block position-right">Contacts</span>
                    </a>
                </li>
                <li class="text-center">
                    <a href="#vendor-capitals" data-toggle="tab" class="legitRipple">
                        <i class="icon-coins"></i>
                        <span class="visible-xs-inline-block position-right">Capitals</span>
                    </a>
                </li>
                <li class="text-center">
                    <a href="#vendor-users" data-toggle="tab" class="legitRipple">
                        <i class="icon-people"></i>
                        <span class="visible-xs-inline-block position-right">Users</span>
                    </a>
                </li>
                <li class="text-center">
                    <a href="#vendor-shareholders" data-toggle="tab" class="legitRipple">
                        <i class="icon-user-tie"></i>
                        <span class="visible-xs-inline-block position-right">Shareholders</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-sm-11">
            <div class="tab-content">
                <div class="tab-pane active" id="vendor-details">
                    <fieldset>
                        <legend class="text-semibold">
                            <i class="icon-file-text2 position-left"></i>
                            Vendor Details
                        </legend>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label"><strong>{{ trans('vendors.attributes.name') }}</strong>:</label>
                                    <div class="form-control-static">{{ $vendor->name }}</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label"><strong>{{ trans('vendors.attributes.registration_number') }}</strong>:</label>
                                    <div class="form-control-static">{{ $vendor->registration_number }}</div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label"><strong>{{ trans('vendors.attributes.tax_1_number') }}</strong>:</label>
                                    <div class="form-control-static">{{ $vendor->tax_1_number }}</div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label"><strong>{{ trans('vendors.attributes.tax_2_number') }}</strong>:</label>
                                    <div class="form-control-static">{{ $vendor->tax_2_number }}</div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label"><strong>{{ trans('vendors.attributes.contact_website') }}</strong>:</label>
                                    <div class="form-control-static">{{ $vendor->contact_website }}</div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend class="text-semibold">
                            <i class="icon-file-text2 position-left"></i>
                            Address
                        </legend>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label"><strong>{{ trans('vendors.attributes.address_1') }}</strong>:</label>
                                    <div class="form-control-static">{{ $vendor->address_1 }}</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label"><strong>{{ trans('vendors.attributes.address_2') }}</strong>:</label>
                                    <div class="form-control-static">{{ $vendor->address_2 }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label"><strong>{{ trans('vendors.attributes.address_postcode') }}</strong>:</label>
                                    <div class="form-control-static">{{ $vendor->address_postcode }}</div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label"><strong>{{ trans('vendors.attributes.address_city_id') }}</strong>:</label>
                                    <div class="form-control-static">{{{ $vendor->city->name or 'No City' }}}</div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label"><strong>{{ trans('vendors.attributes.address_state_id') }}</strong>:</label>
                                    <div class="form-control-static">{{{ $vendor->state->name or 'No State' }}}</div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label"><strong>{{ trans('vendors.attributes.address_country_id') }}</strong>:</label>
                                    <div class="form-control-static">{{{ $vendor->country->name or 'No Country' }}}</div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>

                <div class="tab-pane" id="vendor-contacts">
                    <fieldset>
                        <legend class="text-semibold">
                            <i class="icon-file-text2 position-left"></i>
                            Contacts
                        </legend>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label"><strong>{{ trans('vendors.attributes.contact_person_name') }}</strong>:</label>
                                    <div class="form-control-static">{{ $vendor->contact_person_name }}</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label"><strong>{{ trans('vendors.attributes.contact_email') }}</strong>:</label>
                                    <div class="form-control-static">{{ $vendor->contact_email }}</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label"><strong>{{ trans('vendors.attributes.contact_telephone') }}</strong>:</label>
                                    <div class="form-control-static">{{ $vendor->contact_telephone }}</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label"><strong>{{ trans('vendors.attributes.contact_fax') }}</strong>:</label>
                                    <div class="form-control-static">{{ $vendor->contact_fax }}</div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>

                <div class="tab-pane" id="vendor-capitals">
                    <fieldset>
                        <legend class="text-semibold">
                            <i class="icon-file-text2 position-left"></i>
                            Capitals
                        </legend>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label"><strong>{{ trans('vendors.attributes.capital_currency') }}</strong>:</label>
                                    <div class="form-control-static">{{ $vendor->capital_currency }}</div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label"><strong>{{ trans('vendors.attributes.capital_authorized') }}</strong>:</label>
                                    <div class="form-control-static">{{ $vendor->capital_authorized }}</div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label"><strong>{{ trans('vendors.attributes.capital_paid_up') }}</strong>:</label>
                                    <div class="form-control-static">{{ $vendor->capital_paid_up }}</div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                
                <div class="tab-pane" id="vendor-users">
                    <fieldset>
                        <legend class="text-semibold">
                            <i class="icon-file-text2 position-left"></i>
                            Users
                        </legend>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($vendor->users)
                                    <?php $i = 1; ?>
                                    @foreach ($vendor->users as $user)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                        </tr>
                                        <?php $i++; ?>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="2">No user found.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </fieldset>
                </div>

                <div class="tab-pane" id="vendor-shareholders">
                    <fieldset>
                        <legend class="text-semibold">
                            <i class="icon-file-text2 position-left"></i>
                            Shareholders
                        </legend>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="2">No shareholders found</td>
                                </tr>
                            </tbody>
                        </table>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>