<div role="tabpanel" class="tab-pane active" id="tab-vendor-details">
	<div class="col-xs-12 col-md-3 col-md-push-9">
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