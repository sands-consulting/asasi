@extends('layouts.admin')

@section('header')
<div class="page-title">
    <h4>
        {{ link_to_route('admin.vendors.index', trans('vendors.title')) }} /
        {{ link_to_route('admin.vendors.show', $vendor->name, $vendor->id) }} /
        <span class="text-semibold">{{ trans('vendors.views.show.title') }}</span>
    </h4>
</div>
<div class="heading-elements">
    <div class="heading-btn-group">
        @if($vendor->canApprove())
        <a href="{{ route('admin.vendors.approve', $vendor->id) }}" class="btn btn-link btn-float text-size-small has-text text-blue legitRipple" data-method="PUT" data-confirm="{{ trans('app.confirmation') }}">
            <i class=" icon-checkmark4"></i> <span>{{ trans('vendors.buttons.approve') }}</span>
        </a>
        @endif
        @if($vendor->canReject())
        <a href="{{ route('admin.vendors.reject', $vendor->id) }}" class="btn btn-link btn-float text-size-small has-text text-danger legitRipple" data-toggle="modal" data-target="#reject-modal">
            <i class=" icon-cross2"></i> <span>{{ trans('vendors.buttons.reject') }}</span>
        </a>
        @endif
        @if($vendor->canSuspend())
        <a href="{{ route('admin.vendors.suspend', $vendor->id) }}" class="btn btn-link btn-float text-size-small has-text text-danger legitRipple" data-toggle="modal" data-target="#suspend-modal">
            <i class=" icon-user-lock"></i> <span>{{ trans('vendors.buttons.suspend') }}</span>
        </a>
        @endif
        @if($vendor->canActivate())
        <a href="{{ route('admin.vendors.activate', $vendor->id) }}" class="btn btn-link btn-float text-size-small has-text text-success legitRipple" data-method="PUT">
            <i class=" icon-user-check"></i> <span>{{ trans('vendors.buttons.activate') }}</span>
        </a>
        @endif
        @if($vendor->canBlacklist())
        <a href="{{ route('admin.vendors.blacklist', $vendor->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple" data-toggle="modal" data-target="#blacklist-modal">
            <i class=" icon-user-block"></i> <span>{{ trans('vendors.buttons.blacklist') }}</span>
        </a>
        @endif
        @if($vendor->canUnblacklist())
        <a href="{{ route('admin.vendors.unblacklist', $vendor->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple" data-method="PUT">
            <i class=" icon-user-block"></i> <span>{{ trans('vendors.buttons.unblacklist') }}</span>
        </a>
        @endif
        <a href="{{ route('admin.vendors.edit', $vendor->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple" data-method="GET">
            <i class=" icon-pencil5"></i> <span>{{ trans('vendors.buttons.edit') }}</span>
        </a>
        <a href="{{ route('admin.vendors.index') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class=" icon-undo2"></i> <span>{{ trans('actions.back') }}</span>
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">{{ trans('vendors.views.show.admin.title') }}: {{ $vendor->name }}</h5>
        <div class="heading-elements">
            @if ($vendor->status == 'approved')
                <span class="label label-success heading-text">
            @elseif ($vendor->status == 'suspended')
                <span class="label label-danger heading-text">
            @elseif ($vendor->status == 'blacklisted')
                <span class="label bg-grey-800 heading-text">
            @else
                <span class="label label-default heading-text">
            @endif
            {{ $vendor->status }}</span>
        </div>
    </div>
    
    <div class="panel-body">
        <div class="tabbable">
            <ul class="nav nav-pills nav-pills-toolbar nav-justified">
                <li class="active"><a href="#vendor" data-toggle="tab" class="legitRipple" aria-expanded="true">Vendor Details</a></li>
                <li class=""><a href="#vendor-subscriptions" data-toggle="tab" class="legitRipple" aria-expanded="false">Subscriptions</a></li>
                <li class=""><a href="#vendor-transactions" data-toggle="tab" class="legitRipple" aria-expanded="false">Transactions</a></li>
                {{-- <li class="dropdown">
                    <a href="#" class="dropdown-toggle legitRipple" data-toggle="dropdown" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="#" data-toggle="tab">Dropdown pill</a></li>
                        <li><a href="#" data-toggle="tab">Another pill</a></li>
                    </ul>
                </li> --}}
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="vendors">
                    <div class="tabbable">
                        <div class="row">
                            <div class="col-sm-1">
                                <ul class="nav nav-pills nav-stacked nav-primary">
                                    <li class="active text-center">
                                        <a href="#vendor" data-toggle="tab" class="legitRipple">
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
                                    <div class="tab-pane active" id="vendor">
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
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label"><strong>{{ trans('vendors.attributes.tax_1_number') }}</strong>:</label>
                                                        <div class="form-control-static">{{ $vendor->tax_1_number }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label"><strong>{{ trans('vendors.attributes.tax_2_number') }}</strong>:</label>
                                                        <div class="form-control-static">{{ $vendor->tax_2_number }}</div>
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
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label"><strong>{{ trans('vendors.attributes.address_postcode') }}</strong>:</label>
                                                        <div class="form-control-static">{{ $vendor->address_postcode }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label"><strong>{{ trans('vendors.attributes.address_city_id') }}</strong>:</label>
                                                        <div class="form-control-static">{{{ $vendor->city->name or 'No City' }}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label"><strong>{{ trans('vendors.attributes.address_state_id') }}</strong>:</label>
                                                        <div class="form-control-static">{{{ $vendor->state->name or 'No State' }}}</div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
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
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label"><strong>{{ trans('vendors.attributes.contact_website') }}</strong>:</label>
                                                        <div class="form-control-static">{{ $vendor->contact_website }}</div>
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
                </div>
                
                <div class="tab-pane" id="vendor-subscriptions">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Package</th>
                                <th>Started At</th>
                                <th>Expired At</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($vendor->subscriptions)
                                <?php $i = 1; ?>
                                @foreach ($vendor->subscriptions as $subscription)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $subscription->package->name }}</td>
                                        <td>{{ $subscription->started_at }}</td>
                                        <td>{{ $subscription->expired_at }}</td>
                                        <td>{{ strtolower($subscription->status) }}</td>
                                    </tr>
                                    <?php $i++; ?>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="2">No subscription found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane" id="vendor-transactions">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Reference No</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($vendor->transactions)
                                <?php $i = 1; ?>
                                @foreach ($vendor->transactions as $transaction)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $transaction->reference_number }}</td>
                                        <td>{{ $transaction->amount }}</td>
                                    </tr>
                                    <?php $i++; ?>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="2">No transaction found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


    @include('admin.vendors.modals.reject')
    @include('admin.vendors.modals.suspend')
    @include('admin.vendors.modals.blacklist')
@endsection