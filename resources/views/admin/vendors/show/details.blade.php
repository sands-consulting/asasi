<div role="tabpanel" class="tab-pane active" id="tab-vendor-details">
	<div class="col-md-8">
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h6 class="panel-title">{{ trans('vendors.views.show.details.details.title') }}</h6>
			</div>
			<div class="panel-body">
                <form action="#">
                    <div class="row">
                        <div class="col-xs-12 col-md-3">
                            <label for="name">{{ trans('vendors.attributes.registration_number') }}</label>
                            <p class="form-control-static text-muted">{{ $vendor->registration_number }}</p>
                        </div>
                        <div class="col-xs-12 col-md-9">
                            <label for="name">{{ trans('vendors.attributes.name') }}</label>
                            <p class="form-control-static text-muted">{{ $vendor->name }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <label for="tax_1_number">{{ trans('vendors.attributes.tax_1_number') }}</label>
                            <p class="form-control-static text-muted">{{ $vendor->tax_1_number }}</p>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <label for="tax_2_number">{{ trans('vendors.attributes.tax_2_number') }}</label>
                            <p class="form-control-static text-muted">{{ $vendor->tax_2_number }}</p>
                        </div>
                    </div>
                </form>
			</div>
        </div>
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">{{ trans('vendors.views.show.details.address.title') }}</h6>
            </div>
            <div class="panel-body">
                <form action="#">
                    <div class="row">
                        <div class="col-xs-12 col-md-6 address">
                            <label for="address">{{ trans('vendors.attributes.address_1') }}</label>
                            <p class="form-control-static text-muted">{{ $vendor->address->line_one }}</p>
                        </div>
                        <div class="col-xs-12 col-md-6 address">
                            <label for="address">{{ trans('vendors.attributes.address_2') }}</label>
                            <p class="form-control-static text-muted">{{ $vendor->address->line_two }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="address">{{ trans('vendors.attributes.address_postcode') }}</label>
                            <p class="form-control-static text-muted">{{ $vendor->address->postcode }}</p>
                        </div>
                        <div class="col-md-4">
                            <label for="address">{{ trans('vendors.attributes.address_city_id') }}</label>
                            <p class="form-control-static text-muted">{{ $vendor->address->city->name }}</p>
                        </div>
                        <div class="col-md-4">
                            <label for="address">{{ trans('vendors.attributes.address_country_id') }}</label>
                            <p class="form-control-static text-muted">{{ $vendor->address->country->name }}</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
	</div>
	<div class="col-xs-12 col-md-4">
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h6 class="panel-title">{{ trans('vendors.views.show.details.contact_person.title') }}</h6>
			</div>
			<div class="panel-body">
				<p>{{ $vendor->contact_person_designation }} {{ $vendor->contact_person_name }}
					<br>
					<span class="text-muted">
						<i class="icon-mail5"></i> {{ $vendor->contact_person_email }}<br>
						<i class="icon-phone2"></i> {{ $vendor->contact_person_telephone }}
					</span>
				</p>
			</div>
		</div>

		<div class="panel panel-flat">
			<div class="panel-heading">
				<h6 class="panel-title">{{ trans('vendors.views.show.details.capital.title') }}</h6>
			</div>
			<div class="panel-body">
				<p>{{ trans('vendors.attributes.capital_authorized') }}
					<br>
					<span class="text-muted">{{ $vendor->capital_currency }} {{ $vendor->capital_authorized }}</span>
				</p>
				<p>{{ trans('vendors.attributes.capital_paid_up') }}
					<br>
					<span class="text-muted">{{ $vendor->capital_currency }} {{ $vendor->capital_paid_up }}</span>
				</p>
			</div>
		</div>
	</div>
</div>