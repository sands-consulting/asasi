<div role="tabpanel" class="panel-body tab-pane" id="tab-vendor-contact-person">
	<div class="row">
		<div class="col-xs-12 col-md-3">
			{!! Former::select('contact_person_title')->options(trans('titles'))->required()->label('vendors.attributes.contact_person_title')->addClass('vue-select2') !!}
		</div>
		<div class="col-xs-12 col-md-9">
			{!! Former::text('contact_person_name')->required()->label('vendors.attributes.contact_person_name') !!}
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-md-3">
			{!! Former::text('contact_person_telephone')->required()->label('vendors.attributes.contact_person_telephone') !!}
		</div>
		<div class="col-xs-12 col-md-9">
			{!! Former::text('contact_person_email')->required()->label('vendors.attributes.contact_person_email') !!}
		</div>
	</div>
</div>
