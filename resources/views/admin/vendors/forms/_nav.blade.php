<li role="presentation" class="active">
	<a href="#vendor-details" aria-controls="vendor-details" role="tab" @click.prevent="show">
		<i class=" icon-file-text"></i> {{ trans('vendors.views._form.nav.details') }}
	</a>
</li>
<li role="presentation">
	<a href="#vendor-contact" aria-controls="vendor-contact" role="tab" @click.prevent="show">
		<i class="icon-user-tie"></i> {{ trans('vendors.views._form.nav.contact') }}
	</a>
</li>
<li role="presentation">
	<a href="#vendor-qualification-codes" aria-controls="vendor-qualification-codes" role="tab" @click.prevent="show">
		<i class="icon-folder-check"></i> {{ trans('vendors.views._form.nav.qualification_codes') }}
	</a>
</li>
<li role="presentation">
	<a href="#vendor-shareholders" aria-controls="vendor-shareholders" role="tab" @click.prevent="show">
		<i class="icon-portfolio"></i> {{ trans('vendors.views._form.nav.shareholders') }}
	</a>
</li>
<li role="presentation">
	<a href="#vendor-employees" aria-controls="vendor-employees" role="tab" @click.prevent="show">
		<i class="icon-users4"></i> {{ trans('vendors.views._form.nav.employees') }}
	</a>
</li>
<li role="presentation">
	<a href="#vendor-accounts" aria-controls="vendor-accounts" role="tab" @click.prevent="show">
		<i class="icon-database4"></i> {{ trans('vendors.views._form.nav.accounts') }}
	</a>
</li>
<li role="presentation">
	<a href="#vendor-files" aria-controls="vendor-files" role="tab" @click.prevent="show">
		<i class="icon-stack"></i> {{ trans('vendors.views._form.nav.files') }}
	</a>
</li>