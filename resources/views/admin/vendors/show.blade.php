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
    </div>
    
    <div class="panel-body">
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

        <fieldset>
            <legend class="text-semibold">
                <i class="icon-file-text2 position-left"></i>
                Company Details
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
</div>

<div id="reject-modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title">Reject Form</h5>
            </div>

            {!! Former::open_vertical(route('admin.vendors.reject', $vendor->id))->method('PUT') !!}
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                {!! Former::textarea('remarks')
                                    ->label('vendors.attributes.remarks')
                                    ->rows(5)
                                    ->required() !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link legitRipple" data-dismiss="modal">Close<span class="legitRipple-ripple"></span><span class="legitRipple-ripple"></span></button>
                    <button type="submit" class="btn btn-primary legitRipple">Submit form</button>
                </div>
            {!! Former::close() !!}
        </div>
    </div>
</div>
@endsection