@extends('layouts.admin')

@section('header')
<div class="page-title">
    <h4>
        {{ link_to_route('admin.vendors.index', trans('vendors.views.index.admin.title')) }} /
        {{ link_to_route('admin.vendors.show', $vendor->name, $vendor->id) }} /
        <span class="text-semibold">{{ trans('vendors.views.show.admin.title') }}</span>
    </h4>
</div>
<div class="heading-elements">
    <div class="heading-btn-group">
        <a href="{{ route('admin.vendors.show', $vendor->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class=" icon-undo2"></i> <span>{{ trans('actions.back') }}</span>
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">{{ trans('vendors.views.show.admin.title') }}: {{ $vendor->name }}</h5>
    </div>
    {!! Former::open_vertical(action('Admin\VendorsController@update', $vendor->id))->method('PUT') !!}
        <div class="panel-body">
            <fieldset>
                <legend class="text-semibold">
                    <i class="icon-file-text2 position-left"></i>
                    Vendor Details
                </legend>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label">Name:</label>
                            <div class="form-control-static">{{ $vendor->name }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label">Registration Number:</label>
                            <div class="form-control-static">{{ $vendor->registration_number }}</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label">{{ trans('vendors.attributes.tax_1_number') }}:</label>
                            <div class="form-control-static">{{ $vendor->tax_1_number }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label">{{ trans('vendors.attributes.tax_2_number') }}:</label>
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
                            <label class="control-label">{{ trans('vendors.attributes.address_1') }}:</label>
                            <div class="form-control-static">{{ $vendor->address_1 }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label">{{ trans('vendors.attributes.address_2') }}:</label>
                            <div class="form-control-static">{{ $vendor->address_2 }}</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label">{{ trans('vendors.attributes.address_postcode') }}:</label>
                            <div class="form-control-static">{{ $vendor->postcode }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label">{{ trans('vendors.attributes.address_city_id') }}:</label>
                            <div class="form-control-static">{{ $vendor->address_city_id }}</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label">{{ trans('vendors.attributes.address_state_id') }}:</label>
                            <div class="form-control-static">{{ $vendor->address_state_id }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label">{{ trans('vendors.attributes.address_country_id') }}:</label>
                            <div class="form-control-static">{{ $vendor->address_country_id }}</div>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend class="text-semibold">
                    <i class="icon-file-text2 position-left"></i>
                    Contacts
                </legend>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="control-label">{{ trans('vendors.attributes.contact_name') }}:</label>
                            <div class="form-control-static">{{ $vendor->contact_name }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label">{{ trans('vendors.attributes.contact_telephone') }}:</label>
                            <div class="form-control-static">{{ $vendor->contact_telephone }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label">{{ trans('vendors.attributes.contact_fax') }}:</label>
                            <div class="form-control-static">{{ $vendor->contact_fax }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label">{{ trans('vendors.attributes.contact_email') }}:</label>
                            <div class="form-control-static">{{ $vendor->contact_email }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label">{{ trans('vendors.attributes.contact_website') }}:</label>
                            <div class="form-control-static">{{ $vendor->contact_website }}</div>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend class="text-semibold">
                    <i class="icon-file-text2 position-left"></i>
                    Company Details
                </legend>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">{{ trans('vendors.attributes.capital_currency') }}:</label>
                            <div class="form-control-static">{{ $vendor->capital_currency }}</div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">{{ trans('vendors.attributes.capital_authorized') }}:</label>
                            <div class="form-control-static">{{ $vendor->capital_authorized }}</div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">{{ trans('vendors.attributes.capital_paid_up') }}:</label>
                            <div class="form-control-static">{{ $vendor->capital_paid_up }}</div>
                        </div>
                    </div>
                </div>
            </fieldset>

            <div class="text-right">
                <button type="submit" class="btn btn-primary legitRipple">Approve Vendor <i class="icon-checkmark4 position-right"></i></button>
            </div>
        </div>
    {!! Former::close() !!}
</div>
@endsection