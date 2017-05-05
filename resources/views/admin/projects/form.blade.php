@if(!Auth::user()->hasPermission('projects:organization'))
	<div class="row">
		<div class="col-sm-12"> 
			{!! Former::select('organization_id')
				->label('projects.attributes.organization')
				->options(\App\Organization::getNestedList('name', 'id', '-'), null)
				->addClass('select2')
				->required() !!}
		</div>
	</div>
@endif
<div class="row">
	<div class="col-sm-8">
		{!! Former::text('name')
			->label('projects.attributes.name')
			->required() !!}
	</div>

	<div class="col-sm-4"> 
		{!! Former::text('number')
			->label('projects.attributes.number')
			->required() !!}
	</div>

	<div class="col-sm-12">
		{!! Former::textarea('description')
			->label('projects.attributes.description')
			->required() !!}
	</div>
</div>
<div class="row">
	<div class="col-sm-6"> 
		{!! Former::select('vendor_id')
			->label('projects.attributes.vendor')
			->options(App\Vendor::options())
			->addClass('select2')
			->required() !!}
	</div>
	@if ($project)
	<div class="col-sm-6"> 
		{!! Former::select('managers[]')
			->multiple(true)
			->label('projects.attributes.managers')
			->options(App\User::options())
			->addClass('select2')
			->placeholder('Select Manager')
			->value($project->managers()) !!}
	</div>
	@endif
</div>
<div class="row">
	<div class="col-sm-6"> 
		{!! Former::text('contact_name')
			->label('projects.attributes.contact_name')
			->required() !!}
	</div>
	<div class="col-sm-6"> 
		{!! Former::text('contact_position')
			->label('projects.attributes.contact_position')
			->required() !!}
	</div>
	<div class="col-sm-6"> 
		{!! Former::text('contact_phone')
			->label('projects.attributes.contact_phone')
			->required() !!}
	</div>
	<div class="col-sm-6"> 
		{!! Former::text('contact_fax')
			->label('projects.attributes.contact_fax')
			->required() !!}
	</div>
	<div class="col-sm-6"> 
		{!! Former::text('contact_email')
			->label('projects.attributes.contact_email')
			->required() !!}
	</div>
</div>

<div class="row">
	<div class="col-sm-6"> 
		{!! Former::text('cost')
			->label('projects.attributes.cost')
			->required() !!}
	</div>
	<div class="col-sm-6"> 
		{!! Former::text('progress')
			->label('projects.attributes.progress')
			->required() !!}
	</div>
</div>
<div class="row">
	<div class="col-sm-6"> 
		{!! Former::select('notification')
			->options([
				'' => 'Select Notification', 
				'none' => 'Dont send notification',
				'project_complete' => 'Send upon project completion',
				'milestone_complete' => 'Send upon milestone completion'
			])
			->label('Notifications')
			->required() !!}
	</div>
	<div class="col-sm-6"> 
		{!! Former::select('status')
			->label('allocations.attributes.status')
			->options(collect(trans('statuses'))->only('active', 'inactive'))
			->addClass('select2')
			->required() !!}
	</div>
</div>
<div class="col-sm-12">
	<div class="text-right"> 
		{!! link_to_route('admin.projects.index', trans('actions.cancel'), [], ['class' => 'btn btn-default']) !!}
		{!! Former::submit(trans('actions.save'))->addClass('bg-blue')->data_confirm(trans('app.confirmation')) !!}
	</div>
</div>