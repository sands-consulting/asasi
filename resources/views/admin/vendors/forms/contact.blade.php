<div role="tabpanel" class="tab-pane" id="vendor-contact">
	<div class="row">
		<div class="col-xs-12 col-md-2">
			{!! Former::select('contact_person_designation')
				->label('vendors.attributes.contact_person_designation')
				->options(['Mr' => 'Mr', 'Ms' => 'Ms'])
				->required()
				->addClass('select2') !!}
		</div>
		<div class="col-xs-12 col-md-10">
			{!! Former::text('contact_person_name')
				->label('vendors.attributes.contact_person_name') !!}
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-md-6">
			{!! Former::text('contact_person_telephone')
				->label('vendors.attributes.contact_person_telephone') !!}
		</div>
		<div class="col-xs-12 col-md-6">
			{!! Former::text('contact_person_email')
				->label('vendors.attributes.contact_person_email') !!}
		</div>
	</div>
</div>