<div class="tabbable Prompt--nav-stacked">
    <div class="row">
        <div class="col-sm-2">
            <ul class="nav nav-stacked nav-primary">
                <li class="active text-right">
                    <a href="#vendor-details" data-toggle="tab" class="legitRipple">
                        {{-- <i class="icon-office"></i> --}}
                        <span">Vendors</span>
                    </a>
                </li>
                <li class="text-right">
                    <a href="#vendor-users" data-toggle="tab" class="legitRipple">
                        {{-- <i class="icon-people"></i> --}}
                        <span>Users</span>
                    </a>
                </li>
                <li class="text-right">
                    <a href="#vendor-shareholders" data-toggle="tab" class="legitRipple">
                        {{-- <i class="icon-user-tie"></i> --}}
                        <span>Shareholders</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-sm-10">
            <div class="tab-content">
                <div class="tab-pane active" id="vendor-details">
                    <fieldset>
                        <legend class="text-semibold">
                            <i class="icon-file-text2 position-left"></i>
                            Vendor Details
                        </legend>
                        <div class="row">
                            <div class="col-sm-8">
                                <h5>{{ $vendor->name }} <small>{{ $vendor->registration_number }}</small></h5>
                                {{ $vendor->address_1 }} <br>
                                {{ $vendor->address_2 }} <br>
                                {{ $vendor->address_postcode }} {{{ $vendor->city->name or '' }}} <br>
                                {{{ $vendor->state->name or '' }}} <br>
                                {{{ $vendor->country->name or '' }}} <br><br>
                                {{ trans('vendors.attributes.tax_1_number') }}: {{ $vendor->tax_1_number }} <br>
                                {{ trans('vendors.attributes.tax_2_number') }}: {{ $vendor->tax_2_number }} <br>
                            </div>
                            <div class="col-sm-4">
                                <hr class="visible-xs">
                                <h6>Contact Person</h6>
                                <h5>{{ $vendor->contact_person_name }}</h5>
                                <i class="icon-mail5"></i> <a href="mailto:{{ $vendor->contact_email }}">{{ $vendor->contact_email }}</a> <br>
                                <i class="icon-phone2"></i> {{ $vendor->contact_telephone }} <br>
                                <i class="icon-phone"></i> {{ $vendor->contact_fax }}
                            </div>
                            <div class="col-sm-12">
                                <hr>
                                <h6>Capitals</h6>
                                <strong>{{ trans('vendors.attributes.capital_authorized') }}</strong>: {{ $vendor->capital_currency }} {{ $vendor->capital_authorized }} <br>
                                <strong>{{ trans('vendors.attributes.capital_paid_up') }}</strong>: {{ $vendor->capital_currency }} {{ $vendor->capital_paid_up }} <br>
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