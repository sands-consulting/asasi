<div class="panel-body">
	<div class="row">
		<div class="col-xs-12 col-md-3">
			<ul class="nav nav-pills nav-stacked" role="tablist">
				@include('admin.vendors.forms._nav')
			</ul>
		</div>

		<div class="col-xs-12 col-md-9">
			<div class="tab-content">
				@include('admin.vendors.forms.details')
				@include('admin.vendors.forms.contact')
				@include('admin.vendors.forms.qualification_codes')
				@include('admin.vendors.forms.shareholders')
				@include('admin.vendors.forms.employees')
				@include('admin.vendors.forms.accounts')
				@include('admin.vendors.forms.files')
			</div>
		</div>
	</div>
</div>
