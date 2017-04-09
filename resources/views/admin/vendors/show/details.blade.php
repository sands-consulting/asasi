<div role="tabpanel" class="tab-pane active" id="tab-vendor-details">
	<div class="row">
		<div class="col-xs-12 col-md-6">
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h6 class="panel-title">{{ trans('vendors.views.admin.show.details.address.title') }}</h6>
				</div>
				<div class="panel-body">
					@if($vendor->address)
					<p>
						@if($vendor->address->line_one){{ $vendor->address->line_one }}<br>@endif
						@if($vendor->address->line_two){{ $vendor->address->line_two }}<br>@endif

						@if($vendor->address->postcode){{ $vendor->address->postcode }}
							@if($vendor->address->city){{ $vendor->address->city->name }}@endif
							<br>
						@endif

						@if($vendor->address->state){{ $vendor->address->state->name }}<br>@endif
						@if($vendor->address->country){{ $vendor->address->country->name }}@endif
					</p>
					@else
					<p class="muted">{{ trans('vendors.views.admin.show.details.address.empty') }}</h6>
					@endif
				</div>
			</div>
		</div>

		<div class="col-xs-12 col-md-3">
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h6 class="panel-title">{{ trans('vendors.views.admin.show.details.contact-person') }}</h6>
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
					<h6 class="panel-title">{{ trans('vendors.views.admin.show.details.capital') }}</h6>
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

		<div class="col-xs-12 col-md-3">
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h6 class="panel-title">{{ trans('vendors.views.admin.show.details.tax') }}</h6>
				</div>
				<div class="panel-body">
					<p>{{ trans('vendors.attributes.tax_1_number') }}
						<br>
						<span class="text-muted">{{ blank_icon($vendor->tax_1_number) }}</span>
					</p>
					<p>{{ trans('vendors.attributes.tax_2_number') }}
						<br>
						<span class="text-muted">{{ blank_icon($vendor->tax_2_number) }}</span>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>