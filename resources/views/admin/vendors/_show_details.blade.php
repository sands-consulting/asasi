<div class="row">
	<div class="col-xs-12 col-md-3 col-md-push-9">
		<div class="panel prompt-box full">
			<h4 class="title">{{ trans('vendors.views._show_details.contact_person.title') }}</h4>
			<p>{{ $vendor->contact_person_designation }} {{ $vendor->contact_person_name }}
				<br>
				<span class="text-muted">
					<i class="icon-mail5"></i> {{ $vendor->contact_person_email }}<br>
					<i class="icon-phone2"></i> {{ $vendor->contact_person_telephone }}
				</span>
			</p>
		</div>

		<div class="panel prompt-box full">
			<h4 class="title">{{ trans('vendors.views._show_details.capital.title') }}</h4>
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

	<div class="col-xs-12 col-md-9 col-md-pull-3">
		<div class="panel prompt-box full">
			<h4 class="title">{{ trans('vendors.views._show_details.shareholders.title') }}</h4>
		</div>

		<div class="panel prompt-box full">
			<h4 class="title">{{ trans('vendors.views._show_details.employees.title') }}</h4>
		</div>

		<div class="panel prompt-box full">
			<h4 class="title">{{ trans('vendors.views._show_details.accounts.title') }}</h4>
		</div>
	</div>
</div>